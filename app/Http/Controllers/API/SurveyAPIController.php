<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Survey;
use App\Question;
use App\Option;
use App\Submission;
use App\Answer;

class SurveyAPIController extends Controller
{

    /**
     * Get Individual Survey
     *
     * @param Survey $survey
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function show(Survey $survey)
    {
        return Survey::with('questions', 'questions.options')->find($survey->id);
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
                'question_id' => $question['id'],
                'option_id' => $question["answer"]
            ]));

        }
    }

    /**
     * Create a survey, returns the path to newly created survey
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {

        $survey = $request->input('survey');

        $newSurvey = Survey::create([
            'user_id' => $request->input('user_id'),
            'name'  => $survey["name"],
            'description' => $survey["description"]
        ]);

        foreach ($survey["questions"] as $question) {

            $newQuestion = $newSurvey->questions()->save(new Question([
                'question' => $question["question"]
            ]));

            foreach ($question["options"] as $option) {
                $newQuestion->options()->save(new Option([
                    'label' => $option["label"],
                    'value' => $option["value"] ?: $option["label"]
                ]));
            }

        }
        return $newSurvey->path();
    }

}
