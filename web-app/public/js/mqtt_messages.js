function formatTimeDifference(timeDiff) {
    if (timeDiff < 1) {
        return "just now";
    } else if (timeDiff < 60) {
        return Math.floor(timeDiff) + " min ago";
    } else if (timeDiff < 1440) {
        return Math.floor(timeDiff / 60) + " hour ago";
    } else {
        return Math.floor(timeDiff / 1440) + " day ago";
    }
}

function displayMqttMessages() {
    $.ajax({
        url: '/mqtt-messages',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var $mqttMessagesList = $('#mqtt-messages-list');
            $mqttMessagesList.empty();

            // Limit the number of displayed messages to the last 3
            var startIndex = Math.max(0, data.length - 3);
            var displayedMessages = data.slice(startIndex);

            // Reverse the order of displayed messages (display last message first)
            displayedMessages.reverse();

            // Loop through the last 3 received messages and append them to the list
            var currentTime = new Date().getTime();
            $.each(displayedMessages, function (index, message) {
                // Extract the topic text after the user ID (assuming the topic format is "userID/topicText")
                var topicParts = message.topic.split('/');
                var topicText = topicParts.slice(1).join('/');

                var messageTime = new Date(message.created_at).getTime();
                var timeDiffInMinutes = (currentTime - messageTime) / (1000 * 60);
                var timeText = formatTimeDifference(timeDiffInMinutes);

                // var listItem = '' +
                //     '<strong> ' + topicText + '</strong> ' + message.payload + ' - ' + timeText + '' +
                //     '<br>';
              
                    var listItem = '' +
                    '<div class="">' +
                        '<div class=" d-flex justify-content-between align-items-center">' +
                            '<div  class="text-dark">' +
                                '<b class="text-dark">' + topicText + '</b>: ' + message.payload +
                            '</div>' +
                            '<div class="text-muted">' + timeText + '</div>' +
                        '</div>' +
                    '</div>';
                
            
  

                $mqttMessagesList.append(listItem);
            });
        },
        error: function (error) {
            console.log(error);
        }
    });
}


// Call the displayMqttMessages function initially to load messages on page load
displayMqttMessages();

// Set an interval to refresh messages every 5 seconds (adjust as needed)
setInterval(function () {
    displayMqttMessages();
}, 5000); // 5000 milliseconds = 5 s