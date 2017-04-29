<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function questions()
    {
        return $this->hasMany('App\Questions');
    }

    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = Carbon::parse($value)->diffForHumans();
    }


}
