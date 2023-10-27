<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'account';
    protected $fillable = [
        'owner', 'created', 'modified', 'billing_address', 'billing_city', 'billing_state', 'billing_zip', 'billing_amount', 'active', 'account_name'
    ];
    public function users() {
        return $this->belongsToMany(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($account) {
            $users = User::where('company', $account->id)->get();
            foreach ($users as $user) {
                $user->removeRole('Admin');
                $user->company = null;
                $user->save();
            }
        });
    }
}
