<?php

namespace App;

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

}
