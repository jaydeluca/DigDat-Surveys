<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = [
        'question',
        'options',
        'survey_id'
    ];

    public function survey()
    {
        return $this->belongsTo('App\Survey');
    }

}
