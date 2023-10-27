<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes; // Add the SoftDeletes trait

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles, LogsActivity ,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'company',
        'profile_picture',
        'email',
        'nick_name',
        'address',
        'city',
        'state',
        'zip',
        'password',
        'google_id',
        'email_verified_at',
        'timezone'
    ];
    public function getProfilePictureAttribute($value)
    {
        return asset(Storage::url($value));
    }
    public function accounts() {
        return $this->belongsToMany(Account::class);
    }
    public function account()
{
    return $this->belongsTo(Account::class, 'company');
}

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'last_name','company',
            'profile_picture',
            'email',
            'nick_name',
            'address',
            'city',
            'state',
            'zip',
            'timezone'])->logOnlyDirty(); // Customize the logged attributes as needed
    }

    public function activityLoggingDisabled(): bool
    {
        return $this->wasRecentlyCreated;
    }
    public function getLogNameToUse(string $eventName = ''): string
    {
        return 'user';
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     // Soft deleted timestamp column.
     protected $dates = ['deleted_at']; // Add the 'deleted_at' column for soft delete

}
