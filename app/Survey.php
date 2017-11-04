<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description'
    ];

    /** somethings we want to run without Observers/ServiceProviders  */
    public static function boot()
    {
        self::creating(function($s){
            $s->slug = str_slug($s->name);
        });

        self::updating(function($s){
            $s->slug = str_slug($s->name);
        });

    }


    /**
     * Get a string path for survey
     *
     * @return string
     */
    public function path()
    {
        return $this->user->path() . $this->slug;
    }

    /**
     * Get a string path for the results page for the survey
     *
     * @return string
     */
    public function results()
    {
        return $this->path() . '/results';
    }

    /**
     * User who created / owns this survey
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * A Survey is comprised of questions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    /**
     * Submissions are aggregated answers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions()
    {
        return $this->hasMany('App\Submission');
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
