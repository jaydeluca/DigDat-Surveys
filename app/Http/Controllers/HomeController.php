<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        // get 3 surveys for front page
        $surveys = Survey::all()->take(3);

        return view('pages.welcome')->with(compact('surveys'));
    }

    /**
     * What user sees when logged in
     *  (not sure if this entire controller makes much sense - revisit in future)
     */
    public function home(Request $request)
    {
        $latest_surveys = Survey::all()->take(5);
        $user_surveys = $request->user()->surveys()->get();
        return view('pages.home')->with(compact('latest_surveys', 'user_surveys'));
    }

}
