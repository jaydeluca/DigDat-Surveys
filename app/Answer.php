<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'submission_id',
        'question_id',
        'option_id'
    ];

    /**
     * Submission this Answer belongs to
     */
    public function submission()
    {
        return $this->belongsTo('App\Submission');
    }

    /**
     * Which Question this answer answers
     */
    public function question()
    {
        return $this->hasOne('App\Question');
    }

    /**
     * Which option is the answer
     */
    public function option()
    {
        return $this->hasOne('App\Option');
    }

}
