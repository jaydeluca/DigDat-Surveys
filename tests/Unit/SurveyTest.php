<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SurveyTestTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory('App\User')->create();
        $this->survey = factory('App\Survey')->create();
        $this->question = factory('App\Question')->create(['survey_id' => $this->survey->id]);
    }

    /** @test */
    public function a_survey_has_a_user()
    {
        $user = factory('App\User')->create();
        $survey = $user->surveys()->save(factory('App\Survey')->create());
        $this->assertEquals($user->surveys()->first()->name, $survey->name);
        $this->assertEquals($user->id, $survey->user->id);
    }
}
