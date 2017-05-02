<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'question_id',
        'label',
        'value'
    ];

    /**
     * The Question this option is for
     */
    public function question()
    {
        return $this->belongsTo('App\Question');
    }

}
