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

}
