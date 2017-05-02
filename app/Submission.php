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

    /**
     * The survey this submission belongs to
     */
    public function survey()
    {
        return $this->belongsTo('App\Survey');
    }

    /**
     * A submission's answers (responses)
     */
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

}
