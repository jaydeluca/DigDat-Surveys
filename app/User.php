<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use App\Notifications\MailResetPasswordToken;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** somethings we want to run without Observers/ServiceProviders  */
    public static function boot()
    {
        self::creating(function($u){
            $u->slug = str_slug($u->slug);
        });

    }

    /**
     * Surveys the user created / owns
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function surveys()
    {
        return $this->hasMany('App\Survey');
    }

    public function path()
    {
        return rtrim(env('APP_URL'),'/') . '/surveys/' . $this->slug . '/';
    }

    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($this->getEmailForPasswordReset(), $token));
    }

    /**
     * Mutate to show as diff for humans
     *
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = Carbon::parse($value)->diffForHumans();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
