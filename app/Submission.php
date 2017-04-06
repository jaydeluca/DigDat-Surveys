<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{

    protected $table = 'submissions';

    protected $fillable = [
        'survey_id',
        'ip'
    ];

    public function answers()
    {
        return $this->hasMany('App\Answers');
    }

    public function survey()
    {
        return $this->belongsTo('App\Survey');
    }

}
