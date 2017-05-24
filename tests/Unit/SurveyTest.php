<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SurveyTest extends TestCase
{
    use DatabaseMigrations;

    protected $user, $survey, $question;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory('App\User')->create();
        $this->survey = $this->user->surveys()->save(factory('App\Survey')->create());
        $this->question = factory('App\Question')->create(['survey_id' => $this->survey->id]);
    }

    /** @test */
    public function a_survey_has_a_user()
    {
        $this->assertEquals($this->user->surveys()->first()->name, $this->survey->name);
        $this->assertEquals($this->user->id, $this->survey->user->id);
    }

    /** @test */
    public function a_survey_has_questions()
    {
        $this->assertEquals($this->question->question, $this->survey->questions->first()->question);
    }
}
