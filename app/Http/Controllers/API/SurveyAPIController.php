<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Survey;

class SurveyAPIController extends Controller
{

    /**
     * Get Individual Survey
     */
    public function show(Survey $id)
    {
        return Survey::with('questions')->find($id);
    }

    /**
     * Survey Submission Processing (sent via ajax)
     *
     * @param Request $request
     */
    public function submit(Request $request)
    {
        $data = $request->all();

        $submission = Submission::create([
            'survey_id' => $data['id'],
            'ip' => $request->ip()
        ]);

        foreach ($data['questions'] as $question) {

            $submission->answers()->save(new Answer([
                'question' => $question['question'],
                'answer' => $question['answer'] ? $question['answer'] : 'n/a'
            ]));

        }
    }

}
