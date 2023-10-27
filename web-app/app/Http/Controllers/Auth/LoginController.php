<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Spatie\Activitylog\Models\Activity;
use App\Jobs\MqttSubscriptionJob;
use Illuminate\Support\Facades\Cache;
use Ratchet\Client\Connector;
use Ratchet\Client\WebSocket;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    // protected static $logName = 'login';

    use AuthenticatesUsers, LogsActivity;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        $ipAddress = $request->input('user_ip');
        $location = $this->getUserLocation($ipAddress);
        $device = $this->getUserDevice($request->header('User-Agent'));

        activity()
            ->causedBy($user)
            ->withProperties([
                'ip_address' => $ipAddress,
                'user_agent' => $request->header('User-Agent'),
                'city' => $location['city'],
                'state' => $location['state'],
                'country' => $location['country'],
                'device' => $device,
            ])
            ->log('Login');

              // Subscribe to the topic using the authenticated user ID
        $this->subscribeToMqttTopic($user->id);
    

    }
    private function subscribeToMqttTopic($userId)
    {
        $userId = Auth::id();
        $connector = new Connector();
        $globalTopic = config('app.global_mqtt_topic');
        $websocketUrl = config('app.websocket_url');
        $connector($websocketUrl)->then(function (WebSocket $conn) use ($userId ,$globalTopic) {
            // Subscribe to the topic using the authenticated user ID
            $topic =  $globalTopic . '/' . $userId . '/#';
            $conn->send($topic);
    
            // Close the WebSocket connection immediately after subscribing
            $conn->close();
        }, function (\Exception $e) {
            $this->error("Could not connect: {$e->getMessage()}");
        });
    }
    
    private function getUserLocation($ipAddress)
    {
        $client = new Client();
        $response = $client->get("http://ipinfo.io/{$ipAddress}/json");
        $data = json_decode($response->getBody(), true);

        // Extract the relevant location information (e.g., city, country)
        $location = [
            'city' => isset($data['city']) ? $data['city'] : null,
            'state' => isset($data['region']) ? $data['region'] : null,
            'country' => isset($data['country']) ? $data['country'] : null,
        ];

        return $location;
    }
    private function getUserDevice($userAgent)
    {
        $device = '';
        $userAgent = strtolower($userAgent);

        // Check if the user agent contains specific strings to identify the device type
        if (strpos($userAgent, 'iphone') !== false || strpos($userAgent, 'ipad') !== false) {
            $device = 'iPhone or iPad';
        } elseif (strpos($userAgent, 'android') !== false) {
            $device = 'Android Device';
        } elseif (strpos($userAgent, 'windows') !== false) {
            $device = 'Windows PC or Laptop';
        } elseif (strpos($userAgent, 'macintosh') !== false || strpos($userAgent, 'mac os x') !== false) {
            $device = 'Mac PC or Laptop';
        } else {
            $device = 'Other Device';
        }

        return $device;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['causer_id', 'causer_type', 'description', 'properties','log_name'])
            ->useLogName('Login');
    }
    public function logout(Request $request)
    {
        $user = Auth::user();

        // Find and delete the login log associated with the user
        Activity::where('description', 'Login')
            ->where('causer_id', $user->id)
            ->delete();

            

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/');
    }
  
}
