<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Dock extends Model
{
    use  LogsActivity;
    protected $fillable = [
        'mac', 'code', 'name', 'sw_version', 'hw_version', 'last_online', 'is_online', 'city', 'state', 'zip', 'lat', 'lon', 'owner', 'active', 'last_seen', 'station', 'frequency', 'rx_enabled', 'tx_enabled', 'setting_speaker_out', 'setting_silence', 'setting_audio_trigger', 'setting_speaker_volume', 'setting_max_recording', 'setting_min_recording', 'code_expiry','auto_rec_sound_lv','speaker','notification','line_in_stereo','line_in_channel','line_in_min_db','line_in_gain','ptt_stereo','ptt_channel','ptt_min_db','ptt_gain','address','category','in_use','dock_pack_id','record_line_in','save_ptt_recording','playback_vol','auto_transcribe','auto_level','noise_reduction','upload_line_in','upload_ptt_recording'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
    public function checkAndCreateDock($mac)
    {
        $dock = Dock::where('mac', $mac)->first();

        if (!$dock) {
            $dock = new Dock([
                'mac' => $mac,
                'name' => 'My new Boondock Echo',
                'sw_version' => '1.0',
                'hw_version' => 'ait',
                'last_online' => Carbon::now(),
                'is_online' => 1,
                'last_seen' => Carbon::now()
            ]);
            $dock->save();
        }
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner');
    }
    public function ownby()
    {
        return $this->belongsTo(User::class, 'owner', 'id');
    }
    public function license_code()
    {
        return $this->belongsTo(Devicecodes::class, 'code', 'code');
    }
    
    
    public function user()
    {
    return $this->belongsTo(User::class, 'user_id');
    }
    public function dockpack()
    {
        return $this->belongsTo(Dockpack::class,'dock_pack_id');

    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name','city','state','zip', 'code','owner','auto_transcribe',
            ])->logOnlyDirty(); // Customize the logged attributes as needed
    }

    public function activityLoggingDisabled(): bool
    {
        return $this->wasRecentlyCreated;
    }
    public function getLogNameToUse(string $eventName = ''): string
    {
        return 'dock';
    }

}
