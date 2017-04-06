<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $fillable = [
        'submission_id',
        'question',
        'answer'
    ];

    public function submission()
    {
        return $this->belongsTo('App\Submission');
    }

}
