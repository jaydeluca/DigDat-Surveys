<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Option;

class TakeSurveyTest extends TestCase
{

    use DatabaseMigrations;

    protected $survey, $question;

    public function setUp()
    {
        parent::setUp();

        $this->survey = create('App\Survey');

        $this->question = factory('App\Question')->create(['survey_id' => $this->survey->id]);

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
        $this->get($this->survey->path())
            ->assertSee($this->survey->name);
    }

    /** @test */
    public function a_survey_has_questions()
    {
        // add a question
        $question = factory('App\Question')
            ->create(['survey_id' => $this->survey->id]);

        $this->assertEquals($this->survey->id, $question->survey_id);
    }

    /** @test */
    public function a_question_has_options()
    {
        // add an option
        $option = $this->question->options()->save(new Option([
            'value' => 'Bengals'
        ]));

        $this->assertEquals($this->question->options()->count(), 1);
        $this->assertEquals($this->question->options()->first()->value, $option->value);

        // lets add another
        $this->question->options()->save(new Option([
            'value' => 'Pats'
        ]));

        $this->assertEquals($this->question->options()->count(), 2);
    }

}
