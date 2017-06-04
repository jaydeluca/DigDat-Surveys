<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use JavaScript;
use Analytics;
use Spatie\Analytics\Period;

class SurveyController extends Controller
{

    /**
     * Public facing welcome page with list of recent surveys
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $surveys = Survey::with(['submissions', 'questions'])->get();
        return view('pages.surveys')->with(compact('surveys'));
    }

    /**
     * Form for a user to take a survey (create submission)
     *
     * @param $user_slug
     * @param Survey $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($user_slug, Survey $id)
    {
        JavaScript::put([
            'survey' => $id,
        ]);

        return view('pages.take-survey')->with(['survey' => $id]);
    }

    /**
     * Persist Survey
     *  - Moved to API, not sure which will end up in use yet
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $survey = Survey::create($request->all());

        return redirect('/surveys/'.$survey->id);
    }

    /**
     * Show the Results of a Survey
     * - Most of this page is handled in Vue
     * - See Results.vue
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

    /**
     * Form for creating a new Survey
     * - Most of the heavy lifting is done in Vue
     * - See CreateSurvey.vue
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createSurveyPage()
    {
        JavaScript::put([
            'user_id' => Auth()->user()->id
        ]);

        return view('pages.create-survey');
    }
}
