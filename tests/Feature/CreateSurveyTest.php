<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateSurveyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_authenticated_user_can_create_a_survey()
    {
        // given we have a signed in user
        $this->actingAs(factory('App\User')->create());

        // endpoint is hit for a new survey
        $survey = factory('App\Survey')->make();
        $this->post('/surveys', $survey->toArray());

        // should be redirected to see new survey
        $url = $survey->id;
        // $this->get($url)
        //    ->assertSee($survey->name);
    }

    /** @test */
    public function an_unauthenticated_user_can_not_create_a_survey()
    {
        //$this->expectException('Illuminate\Auth\AuthenticationException');
//        $survey = factory('App\Survey')->make();
//        $this->post('/surveys', $survey->toArray());
//
//        $url = '/surveys/'.$survey->id;
//        $this->assertEquals('/', $survey->path());

        //$this->get($survey->route())->assertSee($survey->name);

    }

    /** @test */
    public function an_authenticated_user_can_create_survey_with_form()
    {
        // given we have a signed in user
        $this->actingAs(factory('App\User')->create());

        $this->get('/surveys/create')->assertSee('Create Survey');
    }

    /** @test */
    public function an_unauthenticated_user_can_not_create_survey_with_form()
    {
        $this->get('/surveys/create')->assertRedirect('/login');
    }

}
