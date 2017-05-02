<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QuestionTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_question_belongs_to_a_survey()
    {
        $survey = factory('App\Survey')->create();
        $question = factory('App\Question')->create(['survey_id' => $survey->id]);
        $this->assertEquals($question->survey->name, $survey->name);
    }
}
