<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SurveyTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->survey = factory('App\Survey')->create();
    }

    /** @test */
    public function a_user_can_browse_all_surveys()
    {
        $this->get('/surveys')
            ->assertSee($this->survey->name);
    }

    /** @test */
    public function a_user_can_browse_a_single_survey()
    {
        $this->get('/surveys/' . $this->survey->id)
            ->assertSee($this->survey->name);
    }

    /** @test */
    public function a_user_can_see_questions()
    {

        // add a question
        $question = factory('App\Questions')
            ->create(['survey_id' => $this->survey->id]);

//        $this->get('/surveys/' . $this->survey->id)
//            ->assertSee($question->question);

    }

}
