<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question',
        'options',
        'survey_id'
    ];

    /**
     * What Survey this question is for
     */
    public function survey()
    {
        return $this->belongsTo('App\Survey');
    }

    /**
     * A question's answer options
     */
    public function options()
    {
        return $this->hasMany('App\Option');
    }

    /**
     * Answers submitted for this question
     */
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

}
