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

}
