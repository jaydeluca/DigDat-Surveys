<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\Submission;
use App\Answers;
use JavaScript;

class SurveyController extends Controller
{


    public function show(Survey $id)
    {
        return Survey::with('questions')->find($id);
    }

    public function submit(Request $request)
    {
        $data = $request->all();

        $submission = Submission::create([
            'survey_id' => $data['id'],
            'ip' => $request->ip()
        ]);

        foreach ($data['questions'] as $question) {

            $submission->answers()->save(new Answers([
                'question' => $question['question'],
                'answer' => $question['answer'] ? $question['answer'] : 'n/a'
            ]));

        }
    }

    public function resultsPage(Survey $survey)
    {


        JavaScript::put([
            'survey' => $survey
        ]);

        return view('results');
    }
}
