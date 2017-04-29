<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\Submission;
use App\Answers;
use JavaScript;
use Analytics;
use Spatie\Analytics\Period;

class SurveyController extends Controller
{

    /**
     * Public facing welcome page with list of recent surveys
     */
    public function index()
    {
        $surveys = Survey::with(['submissions', 'questions'])->get();
        return view('pages.surveys')->with(compact('surveys'));
    }

    /**
     * Show individual Survey
     */
    public function show(Survey $id)
    {
        JavaScript::put([
            'survey' => $id,
        ]);

        return view('pages.take-survey');
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

            $submission->answers()->save(new Answers([
                'question' => $question['question'],
                'answer' => $question['answer'] ? $question['answer'] : 'n/a'
            ]));

        }
    }

    /**
     * Show the Results of a Survey
     *
     * @param Survey $survey
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resultsPage(Survey $survey)
    {
        JavaScript::put([
            'survey' => $survey,
            'submissions' => $survey->submissions()->count(),
            'referrers' => Analytics::fetchTopReferrers(Period::days(90))
        ]);

        return view('results');
    }
}
