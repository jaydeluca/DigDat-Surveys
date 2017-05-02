<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Survey;
use App\Answer;
use App\Question;
use App\Http\Controllers\Controller;

class AnswersAPIController extends Controller
{

    /**
     * Get answers by Survey, formatted for view
     *
     * @param Survey $id
     * @return mixed
     */
    public function show(Survey $id)
    {

        // questions
        $questions = Question::where('survey_id', $id->id)->get()->map(function ($item) {
            return collect($item)->only(['question', 'options']);
        });

        foreach($questions as $question) {
            $question["options"] = collect(json_decode($question["options"]))->map(function ($item) use ($question) {
                return [
                    'option' => $item,
                    'count' => Answer::where('question', $question['question'])->where('answer', $item)->count()
                ];
            });
        }

        return $questions;
    }

}