<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateSurveyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_authenticated_user_can_create_a_survey()
    {
        // given we have a signed in user
        $this->signIn();

        // endpoint is hit for a new survey, should redirect to see survey
        $survey = make('App\Survey');
        $this->post('/surveys', $survey->toArray())
            ->assertRedirect('/surveys/1');
    }

    /** @test */
    public function an_authenticated_user_can_create_survey_with_form()
    {
        // given we have a signed in user
        $this->signIn();

        // able to see the create survey page
        $this->get('/surveys/create')->assertSee('Create Survey');
    }

    /** @test */
    public function an_unauthenticated_user_can_not_create_survey()
    {
        $this->withExceptionHandling()
            ->get('/surveys/create')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->post('/surveys')
            ->assertRedirect('/login');
    }

}
