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

        $questions = Survey::find($id->id)->questions()->get()->map(function ($item) {
            $item["options"] = $item->options()->get()->map(function ($option) {
                return [
                    'option' => $option["label"],
                    'count' => $option->answers()->count()
                ];
            });
            return $item;
        });

        return $questions;
    }

}