<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
// use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Spatie\Activitylog\Models\Activity;
use App\Jobs\MqttSubscriptionJob;
use Illuminate\Support\Facades\Cache;
use Ratchet\Client\Connector;
use Ratchet\Client\WebSocket;

class GoogleController extends Controller
{
    use LogsActivity;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
          
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
        
            $user = Socialite::driver('google')->user();
          

            $finduser = User::where('google_id', $user->id)->first();
           
            if($finduser){
               
                // dd($request);
                // $this->logGoogleLogin();
                // dd($ipAddress);
               
              
        // dd($ipAddress);
        $userId = $finduser->id;
  
        // $mqttTopic = $userId . '/#';
        // MqttSubscriptionJob::dispatch($mqttTopic ,$userId);
        $this->subscribeToMqttTopic($userId);
        Auth::login($finduser);
        return redirect()->intended(route('inbox'));
      
  
         
            }else{
                $password = random_int(10000, 99999);
               $hashedPassword = Hash::make($password);
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'email_verified_at' => now(),                 
                        'google_id'=> $user->id,
                        // 'profile_picture'=> $user->avatar,
                        'password' => $hashedPassword
                        
                    ]);
       
                Auth::login($newUser);
                
                return redirect()->intended(route('inbox'));

            }
        
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    private function subscribeToMqttTopic($userId)
    {
        $connector = new Connector();
        $globalTopic = config('app.global_mqtt_topic');
        $websocketUrl = config('app.websocket_url');
        
        $connector($websocketUrl)->then(function (WebSocket $conn) use ($userId, $globalTopic) {
            // Subscribe to the topic using the authenticated user ID
            $topic = $globalTopic . '/' . $userId . '/#';
            $conn->send($topic);
    
            // Close the WebSocket connection immediately after subscribing
            $conn->close();
        }, function (\Exception $e) {
            $this->error("Could not connect: {$e->getMessage()}");
        });
    }
    
    private function logGoogleLogin(Request $request)
    {
        // $ipAddress = $request->ip();
        // dd($ipAddress);
        // $location = $this->getUserLocation($ipAddress);
        // $device = $this->getUserDevice($request->header('User-Agent'));
        activity()
            ->causedBy($user)->withProperties([
                // 'ip_address' => $ipAddress,
                // 'user_agent' => $request->header('User-Agent'),
                // 'city' => $location['city'],
                // 'state' => $location['state'],
                // 'country' => $location['country'],
                // 'device' => $device,
            ])
            ->log('Login');
    }

    // private function getUserLocation($ipAddress)
    // {
    //     $client = new Client();
    //     $response = $client->get("http://ipinfo.io/{$ipAddress}/json");
    //     $data = json_decode($response->getBody(), true);

    //     // Extract the relevant location information (e.g., city, country)
    //     $location = [
    //         'city' => isset($data['city']) ? $data['city'] : null,
    //         'state' => isset($data['region']) ? $data['region'] : null,
    //         'country' => isset($data['country']) ? $data['country'] : null,
    //     ];

    //     return $location;
    // }
    // private function getUserDevice($userAgent)
    // {
    //     $device = '';
    //     $userAgent = strtolower($userAgent);

    //     // Check if the user agent contains specific strings to identify the device type
    //     if (strpos($userAgent, 'iphone') !== false || strpos($userAgent, 'ipad') !== false) {
    //         $device = 'iPhone or iPad';
    //     } elseif (strpos($userAgent, 'android') !== false) {
    //         $device = 'Android Device';
    //     } elseif (strpos($userAgent, 'windows') !== false) {
    //         $device = 'Windows PC or Laptop';
    //     } elseif (strpos($userAgent, 'macintosh') !== false || strpos($userAgent, 'mac os x') !== false) {
    //         $device = 'Mac PC or Laptop';
    //     } else {
    //         $device = 'Other Device';
    //     }

    //     return $device;
    // }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['causer_id', 'causer_type', 'description', 'properties','log_name'])
            ->useLogName('Login');
    }
}