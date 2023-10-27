#pragma once
#include "AudioCodecs/AudioEncoded.h"
#include "AudioConfig.h"

#ifdef USE_URL_ARDUINO
#include "AudioBasic/StrExt.h"
#include "AudioHttp/URLStream.h"

#define MAX_HLS_LINE 512

namespace audio_tools {

/***
 * @brief We feed the URLLoader with some url strings. At each readBytes or available() call
 * we refill the buffer. The buffer must be big enough to bridge the delays caused by the
 * reloading of the segments
 * @author Phil Schatzmann
 * @copyright GPLv3
*/

class URLLoader {
  public:
  URLLoader() = default;
  ~URLLoader(){
    end();
  }

  bool begin() {
    TRACED();
    buffer.resize(buffer_size, buffer_count);
    active = true;
    return true;
  }

  void end(){
    TRACED();
    stream.end();
    buffer.clear();
    active = false;
  }

  /// Adds the next url to be played in sequence
  void addUrl(const char* url){
    LOGI("Adding %s", url);
    Str url_str(url);
    char *str = new char[url_str.length()+1];
    memcpy(str, url_str.c_str(), url_str.length()+1);
    urls.push_back(str);
  }

  /// Provides the number of open urls which can be played. Refills them, when min limit is reached.
  int urlCount() {
    return urls.size();
  }

  /// Available bytes of the audio stream
  int available()  {
    if(!active) return 0;
    TRACED();
    bufferRefill();
    return buffer.available();
  }

  /// Provides data from the audio stream
  size_t readBytes(uint8_t *data, size_t len)  {
    if(!active) return 0;
    TRACED();
    bufferRefill();
    if (buffer.available()<len) LOGW("Buffer underflow");
    return buffer.readArray(data, len);
  }

  const char *contentType() {
    if (!stream) return nullptr;
    return stream.httpRequest().reply().get(CONTENT_TYPE);
  }

  int contentLength() {
    if (!stream) return 0;
    return stream.contentLength();
  }

  void setBuffer(int size, int count){
    buffer_size = size;
    buffer_count = count;
  }

protected:
  Vector<const char*> urls{10};
  NBuffer<uint8_t> buffer{DEFAULT_BUFFER_SIZE, 10};
  bool active = false;
  int buffer_size = DEFAULT_BUFFER_SIZE;
  int buffer_count = 10;
  URLStream stream;


  /// try to keep the buffer filled
  void bufferRefill() {
    TRACED();
    // we have nothing to do
    if (urls.empty()) {
      LOGD("urls empty");
      return;
    }
    if (buffer.availableForWrite()==0) {
      LOGD("buffer full");
      return;
    }

    // switch current stream if we have no more data
    if ((!stream || stream.totalRead()==stream.contentLength()) && !urls.empty()) {
      LOGD("Refilling");
      const char* url = urls[0];
      urls.pop_front();
      assert(urls[0]!=url);

#ifdef ESP32
      LOGI("Free heap: %d", ESP.getFreeHeap());
#endif
      LOGI("Playing %s of %d", url, urls.size());

      stream.clear();
      stream.setWaitForData(true);
      if (!stream.begin(url)){
        TRACEE();
      }
      // free memory
      delete(url);
    }

    // copy data to buffer
    //LOGD("waitForData");
    //stream.waitForData();
    int to_write = min(buffer.availableForWrite(),DEFAULT_BUFFER_SIZE);
    if (to_write>0){
      int total = 0;
      while(to_write>0){
        if (stream.totalRead()==stream.contentLength()) break;
        uint8_t tmp[to_write]={0};
        int read = stream.readBytes(tmp, to_write);
        total += read;
        if (read>0){
          buffer.writeArray(tmp, read);      
          to_write = min(buffer.availableForWrite(),DEFAULT_BUFFER_SIZE);
        } else {
          delay(50);
        }
      }
      LOGD("Refilled with %d now %d available to write", total, buffer.availableForWrite());
    }
  }
};

/**
 * Prevent that the same url is loaded twice. We limit the history to
 * 20 entries.
*/
class URLHistory {
  public:
    bool add(const char *url){
      bool found = false;
      Str url_str(url);
      for (int j=0;j<history.size();j++){
        if (url_str.equals(history[j])){
          found = true;
          break;
        }
      }
      if (!found){
        char *str = new char[url_str.length()+1];
        memcpy(str, url, url_str.length()+1);
        history.push_back(str);
        if (history.size()>20){
          delete(history[0]);
          history.pop_front();
        }
      }
      return !found;
    }

    void clear(){
      history.clear();
    }
  protected:
    Vector<const char*> history;
};

/**
 * @brief Simple Parser for HLS data. We select the entry with min bandwidth
 * @author Phil Schatzmann
 * @copyright GPLv3
 */
class HLSParser {
 public:
  // loads the index url
  bool begin(const char *urlStr) {
    index_url_str = urlStr;
    return begin();
  }

  bool begin() {
    TRACEI();
    custom_log_level.set();
    segments_url_str = "";
    bandwidth = 0;
    if (!parseIndex()){
      TRACEE();
      return false;
    }
    if (!parseSegments()){
      TRACEE();
      return false;
    }
    if (!url_loader.begin()){
      TRACEE();
      return false;
    }
    custom_log_level.reset();
    return true;
  }

  int available() {
    TRACED();
    if (!active) return 0;
    custom_log_level.set();
    reloadSegments(this);
    int result = url_loader.available();
    custom_log_level.reset();
    return result;
  }

  size_t readBytes(uint8_t* buffer, size_t len){
    TRACED();
    if (!active) return 0;
    custom_log_level.set();
    reloadSegments(this);
    size_t result = url_loader.readBytes(buffer, len);
    custom_log_level.reset();
    return result;
  }

  const char *indexUrl() {
    return index_url_str;
  }

  const char *segmentsUrl() {
    if (segments_url_str==nullptr) return nullptr;
    return segments_url_str.c_str();
  }

  /// Provides the codec
  const char *getCodec() { return codec.c_str(); }

  /// Provides the content type of the audio data
  const char *contentType() {
    return url_loader.contentType();
  }

  int contentLength() {
    return url_loader.contentLength();
  }

  /// Closes the processing
  void end() {
    TRACEI();
    codec.clear();
    segments_url_str.clear();
    url_stream.end();
    url_loader.end();
    url_history.clear();
  }

  /// Defines the number of urls that are preloaded in the URLLoader
  void setUrlCount(int count){
    url_count = count;
  } 

  /// Defines the class specific custom log level
  void setLogLevel(AudioLogger::LogLevel level){
    custom_log_level.set(level);
  }

  void setBuffer(int size, int count){
    url_loader.setBuffer(size, count);
  }

 protected:
  CustomLogLevel custom_log_level;
  int bandwidth = 0;
  int url_count = 5;
  bool url_active = false;
  bool is_extm3u = false;
  StrExt codec;
  StrExt segments_url_str;
  StrExt url_str;
  const char *index_url_str = nullptr;
  URLStream url_stream;
  URLLoader url_loader;
  bool active = false;
  int media_sequence = 0;
  int tartget_duration_ms=5000;
  int segment_count;
  uint64_t next_sement_load_time = 0;
  URLHistory url_history;

  // trigger the reloading of segments if the limit is underflowing
  static void reloadSegments(void *ref){
    TRACED();
    HLSParser *self = (HLSParser*)ref;
    // get new urls
    if (!self->segments_url_str.isEmpty()
    && self->tartget_duration_ms!=0){ 
    //&& millis() > self->next_sement_load_time){
      //self->next_sement_load_time = millis() + self->tartget_duration_ms;
      self->parseSegments();
    }
  }

  // parse the index file and the segments
  bool parseIndex() {
    TRACED();
    url_stream.setTimeout(1000);
    url_stream.setConnectionClose(false);
    // we only update the content length
    url_stream.httpRequest().reply().put(CONTENT_LENGTH, 0);
    url_stream.setAutoCreateLines(false);
    bool rc = url_stream.begin(index_url_str);
    url_active = true;
    rc  = parse(true);
    return rc;
  }

  // parse the segment url provided by the index
  bool parseSegments() {
    TRACED();
    if (millis()<next_sement_load_time) return false;
    if (url_stream) url_stream.clear();
    LOGI("parsing %s", segments_url_str.c_str());

    if (segments_url_str.isEmpty()){
      TRACEE();
      return false;
    }

    if (!url_stream.begin(segments_url_str.c_str())){
      TRACEE();
      return false;
    }

    segment_count = 0;
    if (!parse(false)){
      TRACEE();
      return false;
    }

    next_sement_load_time = millis() + (segment_count * tartget_duration_ms);
    
    active = true;
    return true;
  }

  // parse the index file and the segments
  bool parse(bool process_index) {
    LOGI("parsing %s", process_index ? "Index" : "Segements")
    char tmp[MAX_HLS_LINE];
    bool result = true;
    is_extm3u = false;

    // parse lines
    memset(tmp, 0, MAX_HLS_LINE);
    while (url_stream.available()) {
      memset(tmp, 0, MAX_HLS_LINE);
      url_stream.httpRequest().readBytesUntil('\n', tmp, MAX_HLS_LINE);
      Str str(tmp);

      // check header
      if (str.indexOf("#EXTM3U")>=0) {
        is_extm3u = true;
      }

      if (is_extm3u) {
        if (process_index) {
          if (!parseIndexLine(str)){
            return false;
          }
        } else {
          if (!parseSegmentLine(str)){
            return false;
          }
        }
      } 
    }

    return result;
  }

  // Add all segments to queue
  bool parseSegmentLine(Str &str) {
    TRACED();
    LOGI("> %s", str.c_str());

    int pos = str.indexOf("#"); 
    if (pos>=0){
      LOGI("-> Segment:  %s", str.c_str());

      pos = str.indexOf("#EXT-X-MEDIA-SEQUENCE:"); 
      if (pos>=0){
          int new_media_sequence = atoi(str.c_str()+pos+22);
          LOGI("media_sequence: %d", new_media_sequence);
          if (new_media_sequence == media_sequence){
            LOGW("MEDIA-SEQUENCE already loaded: %d", media_sequence);
            return false;
          }
          media_sequence = new_media_sequence;
      }

      pos = str.indexOf("#EXT-X-TARGETDURATION:"); 
      if (pos>=0){
          const char* duration_str = str.c_str()+pos+22;
          tartget_duration_ms = 1000 * atoi(duration_str);
          LOGI("tartget_duration_ms: %s %d",duration_str, tartget_duration_ms);
          // use updated value
      }
    } else {
      segment_count++;
      if (url_history.add(str.c_str())){
        // provide audio urls to the url_loader
        if (str.startsWith("http")) {
          url_str = str;
        } else {
          // we create the complete url
          url_str = segments_url_str;
          url_str.add("/");
          url_str.add(str.c_str());
        }
        url_loader.addUrl(url_str.c_str());
      } else {
        LOGD("Douplicate ignored: %s", str.c_str());
      }
    }
    return true;
  }

  // Determine codec for min bandwidth
  bool parseIndexLine(Str &str) {
    TRACED();
    LOGI("> %s", str.c_str());
    int tmp_bandwidth;
    if (str.indexOf("EXT-X-STREAM-INF") >= 0) {
      // determine min bandwidth
      int pos = str.indexOf("BANDWIDTH=");
      if (pos > 0) {
        Str num(str.c_str() + pos + 10);
        tmp_bandwidth = num.toInt();
        url_active = (tmp_bandwidth < bandwidth || bandwidth == 0);
        if (url_active) {
          bandwidth = tmp_bandwidth;
          LOGD("-> bandwith: %d", bandwidth);
        }
      }

      pos = str.indexOf("CODECS=");
      if (pos > 0) {
        int start = pos + 8;
        int end = str.indexOf('"', pos + 10);
        codec.substring(str, start, end);
        LOGI("-> codec: %s", codec.c_str());
      }
    }

    if (str.startsWith("http")) {
      // check if we have a valid codec
      segments_url_str.set(str);
      LOGD("segments_url_str = %s", str.c_str());
    }

    return true;
  }
};

/**
 * @brief HTTP Live Streaming using HLS: The result is a MPEG-TS data stream
 * that must be decoded e.g. with a DecoderMTS.
 *
 * @author Phil Schatzmann
 * @ingroup http *@copyright GPLv3
 */

class HLSStream : public AudioStream {
 public:
  HLSStream() = default;

  HLSStream(const char *ssid, const char *password) {
    setSSID(ssid);
    setPassword(password);
  }

  bool begin(const char *urlStr) {
    TRACEI();
    login();
    // parse the url to the HLS
    bool rc = parser.begin(urlStr);
    return rc;
  }

  bool begin() { 
    TRACEI();
    login();
    bool rc = parser.begin(); 
    return rc;
  }

  // ends the request
  void end() { parser.end(); }

  /// Sets the ssid that will be used for logging in (when calling begin)
  void setSSID(const char *ssid) { this->ssid = ssid; }

  /// Sets the password that will be used for logging in (when calling begin)
  void setPassword(const char *password) {this->password = password;}

  /// Returns the string representation of the codec of the audio stream
  const char *codec() { return parser.getCodec(); }

  const char *contentType() {
    return parser.contentType();
  }

  int contentLength() {
    return parser.contentLength();
  }

  int available() override {
    TRACED();
    return parser.available();
  }

  size_t readBytes(uint8_t *data, size_t len) override {
    TRACED();
    return parser.readBytes(data, len);
  }

  /// Defines the class specific custom log level
  void setLogLevel(AudioLogger::LogLevel level){
    parser.setLogLevel(level);
  }

  /// Defines the buffer size
  void setBuffer(int size, int count){
    parser.setBuffer(size, count);
  }

 protected:
  HLSParser parser;
  const char* ssid = nullptr;
  const char* password = nullptr;

  void login(){
#ifdef USE_WIFI
      if (ssid!=nullptr && password != nullptr && WiFi.status() != WL_CONNECTED){
          TRACED();
          WiFi.begin(ssid, password);
          while (WiFi.status() != WL_CONNECTED){
              Serial.print(".");
              delay(500); 
          }
      }
#else   
      LOGW("login not supported");
#endif          
  }
};

}  // namespace audio_tools

#endif