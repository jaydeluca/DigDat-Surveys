<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Survey;
use JavaScript;

class SurveyController extends Controller
{

    /**
     * Public facing welcome page with list of recent surveys
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($user_slug=null)
    {
        $owner = null;
        if (!$user_slug){
            $surveys = Survey::with(['submissions', 'questions'])->get();
        } else {
            $owner = User::where('slug', $user_slug)->first();
            if (!$owner){
                return abort(404);
            } else {
                $surveys = Survey::where('user_id', $owner->id)
                                 ->with(['submissions', 'questions']
                                 )->get();
             }
        }
        return view('pages.surveys')->with(compact('surveys','owner'));
    }

    /**
     * Form for a user to take a survey (create submission)
     *
     * @param $user_slug
     * @param Survey $survey
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($user_slug, Survey $survey)
    {
        JavaScript::put([
            'survey' => $survey,
        ]);

        return view('pages.take-survey')->with(['survey' => $survey]);
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

    /**
     * Show the Results of a Survey
     *
     * @param Survey $survey
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resultsPage($user_slug, Survey $survey)
    {
        $questions = $this->formatSurveyQuestions($survey);
        $submissions = $survey->submissions()->count();

        return view('pages.results', compact('survey', 'questions', 'submissions'));
    }

    /**
     * Format the data to include some meta data calculations
     *
     * @param Survey $survey
     * @return mixed
     */
    public function formatSurveyQuestions(Survey $survey)
    {
        return Survey::find($survey->id)->questions()->get()->map(function ($item) {
            $item["options"] = $item->options()->get()->map(function ($option) {
                return [
                    'option' => $option["label"],
                    'count' => $option->answers()->count()
                ];
            });
            $item["total"] = $item["options"]->pluck('count')->sum();
            return $item;
        });
    }

}
