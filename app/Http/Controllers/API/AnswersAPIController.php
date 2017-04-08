<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Survey;
use App\Submission;
use App\Answers;
use App\Questions;
use App\Http\Controllers\Controller;

class AnswersAPIController extends Controller
{


    public function show(Survey $id)
    {

        // questions

        $questions = Questions::where('survey_id', $id->id)->get()->map(function ($item) {
            return collect($item)->only(['question', 'options']);
        });

        foreach($questions as $question) {
            $question["options"] = collect(json_decode($question["options"]))->map(function ($item) use ($question) {
                return [
                    'option' => $item,
                    'count' => Answers::where('question', $question['question'])->where('answer', $item)->count()
                ];
            });
        }

        return $questions;

    }


}