<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UseradminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\OutboxController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AllinboxController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MyaccountController;
use App\Http\Controllers\DockController;
use App\Http\Controllers\DockpackController;
use App\Http\Controllers\MydockController;
use App\Http\Controllers\DockadminController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MqttController;
use App\Http\Controllers\FccController;
use App\Http\Controllers\ActivityController; 
use App\Http\Controllers\TimelineController ; 
use App\Http\Controllers\ProxyAudioController;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\AudioAlertController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\SchedularController;  
use App\Http\Controllers\UserActivityController;  
use App\Http\Controllers\HomeController;  
use App\Http\Controllers\ActivityStreamController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\NewsroomController;
use App\Http\Controllers\NewsAdminController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ErrorCodeManagementController;
use App\Http\Controllers\TextToSpeechController;

 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });

// Route::get('/inbox', function () {
//     return view('inbox');
// });

// Route::get('/index', function () {
//     return view('index');
// });

//

Route::get('/ui', function () {
    return view('invite/index');
})->name('add');

Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/news', [NewsroomController::class, 'index'])->name('newsroom.index');
Route::get('/news/{id}', [NewsroomController::class, 'show'])->name('newsroom.news_detail');

Route::middleware(['auth'])->group(function () {
    Route::get('profile',[ProfileController::class,'index'])->name('profile');
    Route::post('profile/{user}',[ProfileController::class,'update'])->name('profile.update');
    Route::post('storecompany', [MyaccountController::class, 'storecompany'])->name('storecompany');
    // contact 
Route::middleware(['web', 'permission:contact-dashboard'])->get('/contacts', [ContactController::class, 'index'])->name('contacts.index');


//alerts

Route::get('/alerts', [AlertController::class, 'showAlerts'])->name('alerts.show');
Route::delete('/alerts/{id}', [AlertController::class, 'destroy'])->name('alerts.destroy');
Route::get('/fetch-monitor-table',[MonitorController::class,'fetchMonitorTable'])->name('fetch_monitor_table');
// audio alert 
Route::resource('audio_alerts', AudioAlertController::class);

// proxy server 
Route::get('/proxy-audio', [ProxyAudioController::class, 'getAudio']);


Route::post('/invite', [InvitationController::class, 'sendInvitation'])->name('invite.create');
Route::get('/inviteregister/{token}', [InvitationController::class, 'showRegistrationForm'])->name('invite.register');
Route::post('/inviteregister/{token}', [InvitationController::class, 'register'])->name('invite.register.submit');


Route::post('/mqtt/publish', [MqttController::class, 'publishMessage'])->name('mqtt.publish');
Route::get('/subscribe', [MqttController::class, 'subscribeToTopic'])->name('mqtt.subscribeToTopic');
Route::get('/mqtt-subscribe', [MqttController::class, 'mqttSubscribe']);
Route::get('/mqtt-messages', [MqttController::class, 'showMessages']);
Route::get('/messageblade', [MqttController::class, 'messageblade']);


Route::get('/mqtt/subscribe', [ActivityController::class, 'myControllerMethod'])->name('mqtt.subscribe');
Route::put('/mqtt/{id}/update', [MqttController::class, 'update'])->name('mqtt.update');
Route::get('/mqtt-page', [MqttController::class, 'test'])->name('mqtt-page');
Route::post('/activity/on-message-arrived', [ActivityController::class, 'onMessageArrived'])->name('activity');

});

Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');

});
Route::get('uploads', [FileController::class, 'index']);
Route::post('uploads', [FileController::class, 'store']);


Route::middleware(['web', 'permission:monitor-dashboard'])->group(function () {
    Route::get('logs', [LogViewerController::class, 'index']);
});


// roles and Permission
Route::group(['middleware' => ['auth']], function() {
  

    // inbox
    Route::get('/receive', [InboxController::class, 'index'])->name('inbox')->where('filter', '^(true|false)$');
    Route::get('/receivedtable', [InboxController::class, 'receivedtable'])->name('receivedtable');
    Route::get('/get-new-messages-count/{lastViewedTime}', [InboxController::class, 'getNewMessagesCount'])->name('getNewMessagesCount');


Route::post('inbox', [InboxController::class, 'store'])->name('inboxstore');
Route::delete('inbox/{id}', [InboxController::class, 'delete'])->name('inbox.delete');
Route::post('/delete-audio-files', [InboxController::class, 'deleteSelected'])->name('inbox.deleteSelected');
Route::post('/delete-audio-favorite', [FavoriteController::class, 'deleteSelected'])->name('favorites.deleteSelected');
Route::get('/transcribe-audio/{id}', [InboxController::class, 'transcribeAudio'])->name('transcribe-audio');
Route::resource('allinbox', AllinboxController::class);
// all Inbox
Route::resource('station', StationController::class);
Route::resource('favorites', FavoriteController::class);
Route::post('/favorites/add', [FavoriteController::class, 'add'])->name('favorites.add');

Route::put('/description/{id}', [FavoriteController::class, 'description'])->name('favorites.description');
Route::put('/stationdockupdate/{id}', [StationController::class, 'stationdockupdate'])->name('stationdockupdate');
Route::delete('/stationdockremove/{id}', [StationController::class, 'stationdockremove'])->name('stationdockremove');
Route::post('/stations/delete', [StationController::class, 'delete'])->name('station.delete');


// pack route
Route::get('pack/{id}', [PackController::class, 'index'])
    ->name('pack')
    ->middleware('dockpack.owner');

// outbox
Route::resource('outbox', OutboxController::class);
//timeline
Route::resource('timeline', TimelineController::class);



Route::resource('myaccount', MyaccountController::class);


// docks
Route::group(['middleware' => ['role:Super Admin']], function () {
    Route::resource('docks', DockController::class);
    // account
  Route::resource('accounts', AccountController::class);

  Route::resource('roles', RoleController::class);
  Route::resource('users', UserController::class);
  
});
Route::post('/user/update-live-mode', [UserController::class, 'updateLiveMode'])->name('user.updateLiveMode');
Route::post('/update-dark-mode', [UserController::class, 'updateDarkMode'])->name('updateDarkMode');
Route::get('/user/get-original-audio', [UserController::class, 'getOriginalAudio'])->name('user.getOriginalAudio');
Route::post('/user/update-original-audio', [UserController::class, 'updateOriginalAudio'])->name('user.updateOriginalAudio');








// dock admin

Route::resource('dockadmin', DockadminController::class);
// user admin
Route::resource('useradmin', UseradminController::class);

// My docks
Route::resource('mydocks', MydockController::class);
Route::put('/mydocks', [MydockController::class, 'updatenewdock'])->name('mydocks.updatenewdock');
Route::post('/mydocks/activation', [MydockController::class, 'activation'])->name('mydocks.activation');
Route::delete('/mydocks/delete_alldockAudio/{id}', [MydockController::class, 'delete_alldockAudio'])
    ->name('mydocks.delete_alldockAudio');

// dock pack
Route::resource('dockpack', DockpackController::class);
Route::post('/dockpack/update_in_use', [DockpackController::class, 'updateInUse'])->name('update_in_use');
Route::post('/dockpack/update_in_usesett/{id}', [DockpackController::class, 'update_in_usesett'])->name('update_in_usesett');
Route::post('/dockpack/update_available_docks', [DockpackController::class, 'update_available_docks'])->name('update_available_docks');
Route::post('/dockpack/update_available_docksett/{id}', [DockpackController::class, 'update_available_docksett'])->name('update_available_docksett');
Route::put('/dockpack/dock_enable/{id}', [DockpackController::class, 'dock_enable'])->name('dock_enable');
Route::get('/get-data', [DockpackController::class, 'getData'] )->name('get-data');
Route::get('/dockpacksett_container/{id}', [DockpackController::class, 'dockpacksett_container'] )->name('dockpacksett_container');
Route::get('/available_docks', [DockpackController::class, 'available_docks'] )->name('available_docks');
Route::get('/available_docksett/{id}', [DockpackController::class, 'available_docksett'] )->name('available_docksett');
Route::get('/fcccheck', [FccController::class, 'fcccheck'])->name('fcccheck');
Route::get('/fcc', [FccController::class, 'index']);
// Route::post('/fcc', [FccController::class, 'search'])->name('fcc.search');


// scdular 
Route::resource('schedular', SchedularController::class);
Route::patch('/schedular/{id}/disable', [SchedularController::class, 'disable'])->name('schedular.disable');
Route::patch('/schedular/{id}/activate', [SchedularController::class, 'activate'])->name('schedular.activate');
Route::delete('/schedularlog/{id}', [SchedularController::class, 'scdeularLog_delete'])->name('scdeularLog_delete');


Route::resource('user_activity', UserActivityController::class);
Route::post('/force_logout/{userId}', [UserActivityController::class, 'forceLogout'])->name('force_logout');

Route::get('/node', function () {
    return view('node'); // Replace 'mqtt' with the appropriate view name if needed
});



Route::get('/explore', [ExploreController::class, 'index'])->name('explore.index');

Route::get('/import-csv', [ExploreController::class, 'importCsvForm'])->name('import-csv-form');
Route::post('/import-csv', [ExploreController::class, 'importCsv'])->name('import-csv');
Route::post('/export-csv', [ExploreController::class, 'exportCsv'])->name('export-csv');


 
 
Route::post('/explore/store', [ExploreController::class, 'store'])->name('explore.store');
Route::get('/error_code_management', [ErrorCodeManagementController::class, 'index'])->name('error_code_management.index');
Route::post('/error_code_management', [ErrorCodeManagementController::class, 'store'])->name('error_code_management.store');
Route::put('/error_code_management/update/{id}', [ErrorCodeManagementController::class, 'update'])->name('error_code_management.update');
Route::delete('/error_code_management/{id}', [ErrorCodeManagementController::class, 'destroy'])->name('error_code_management.destroy');


Route::delete('/activity/delete-all', [ActivityStreamController::class, 'deleteAll'])->name('activity.delete.all'); // New route for deleting all messages
Route::delete('/delete/messages', [ActivityStreamController::class, 'delete'])->name('delete.messages');
Route::get('/activitystream', [ActivityStreamController::class, 'index'])->name('activity.index');

Route::get('/license/{id}', [LicenseController::class, 'register_code_details'])->name('license.details');
Route::get('/license_admin', [LicenseController::class, 'index'])->name('license.index');
Route::post('/licenses', [LicenseController::class, 'store'])->name('license.store');
Route::post('/generate-audio', [TextToSpeechController::class, 'generateAudio']);
Route::get('/generate-audio', [TextToSpeechController::class, 'showForm']);
});











Route::group(['middleware' => ['role:Super Admin']], function () {
// Routes for listing, creating, and storing news articles
Route::get('/news-admin', [NewsAdminController::class, 'index'])->name('news-admin.index');
Route::get('/news-admin/create', [NewsAdminController::class, 'create'])->name('news-admin.create');
Route::post('/news-admin', [NewsAdminController::class, 'store'])->name('news-admin.store');

// Routes for showing, editing, updating, and deleting news articles
Route::get('/news-admin/{article}', [NewsAdminController::class, 'show'])->name('news-admin.show');
Route::get('/news-admin/{article}/edit', [NewsAdminController::class, 'edit'])->name('news-admin.edit');
Route::put('/news-admin/{article}', [NewsAdminController::class, 'update'])->name('news-admin.update');
// Route::put('/news-admin/{article}', [NewsAdminController::class, 'updatedata'])->name('news-admin.updatedata');

Route::delete('/news-admin/{article}', [NewsAdminController::class, 'destroy'])->name('news-admin.destroy');
Route::post('/news-admin/update-publish', [NewsAdminController::class, 'postpublish'])->name('postpublish');
Route::post('/news-admin/update-pinned', [NewsAdminController::class, 'postpinned'])->name('postpinned');


// Route for updating the image
Route::post('/news-admin/update-image/{article}/{imageType}', [NewsAdminController::class, 'updateImage'])->name('news-admin.updateImage');
Route::post('/update-hero-image', [NewsAdminController::class, 'updateHeroImage'])->name('update-hero-image');
Route::post('news-admin/delete-selected', [NewsAdminController::class, 'deleteSelected'])->name('news-admin.delete-selected');
Route::put('/news-admin/{article}/update-images', [NewsAdminController::class, 'updateImages'])->name('news-admin.updateImages');

});
Route::post('/contacts', [ContactController::class, 'store'])->middleware('guest')->name('contacts.store');
// Route::put('/news-admin/{article}/update-images', [NewsAdminController::class, 'updateImages'])->name('news-admin.updateImages');
