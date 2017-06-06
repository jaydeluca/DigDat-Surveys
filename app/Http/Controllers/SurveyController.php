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
    public function resultsPage(Survey $survey)
    {
        $questions = Survey::find($survey->id)->questions()->get()->map(function ($item) {
            $item["options"] = $item->options()->get()->map(function ($option) {
                return [
                    'option' => $option["label"],
                    'count' => $option->answers()->count()
                ];

            });
            $item["total"] = $item["options"]->pluck('count')->sum();
            return $item;
        });

        $submissions = $survey->submissions()->count();

        return view('pages.results', compact('survey', 'questions', 'submissions'));
    }

}
