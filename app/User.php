<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use App\Position;
use App\EventsPisitionsUser;

class User extends Authenticatable
{
	use Notifiable;
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'status',
		'firstname',
		'lastname',
		'organization',
		'nickname',
		'email',
		'phone',
		'country',
		'profile_pic_url',
		'signup_invite_code',
		'password',
		'api_token',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function roles()
	{
		return $this->belongsToMany(Role::class)->withTimestamps();
	}

	public function verifyRoles($roles)
	{
		if ($this->hasAnyRole($roles)) {
			return true;
		}
		return false;
	}

	public function hasAnyRole($roles)
	{
		if (is_array($roles)) {
			foreach ($roles as $role) {
				if ($this->hasRole($role)) {
					return true;
				}
			}
		} else {
			if ($this->hasRole($roles)) {
				return true;
			}
		}
		return false;
	}

	public function hasRole($role)
	{
		if ($this->roles()->where('slug', $role)->first()) {
			return true;
		}

		return false;
	}

	public function getPhoto()
    {
        // if (!$profile_pic_url || starts_with($profile_pic_url, 'http')) {
        //     return $profile_pic_url;
        // }

        if (empty(trim($this->profile_pic_url))) {
        	return asset('images/avatar.png');
        }

        return Storage::disk(env('APP_DISK'))->url($this->profile_pic_url)."?ver=".rand();
    }
}
