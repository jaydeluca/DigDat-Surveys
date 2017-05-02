<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Question;
use App\Option;
use App\Submission;
use App\Answer;

class QuestionTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->survey = factory('App\Survey')->create();
        $this->question = factory('App\Question')->create(['survey_id' => $this->survey->id]);
    }

    /** @test */
    public function a_question_belongs_to_a_survey()
    {
        $this->assertEquals($this->question->survey->name, $this->survey->name);

        $this->survey->questions()->save(new Question([
            'question' => "is the earth flat?"
        ]));

        $this->assertEquals($this->survey->questions()->count(), 2);
    }

    /** @test */
    public function a_question_has_options()
    {
        // add an option
        $this->question->options()->save(new Option([
            'value' => 'Blue'
        ]));
        $this->assertEquals($this->question->options()->count(), 1);

        // test another
        $this->question->options()->save(new Option([
            'value' => 'Green'
        ]));
        $this->assertEquals($this->question->options()->count(), 2);
    }

    /** @test */
    public function a_question_has_answers()
    {
        // create a question
        $question = $this->survey->questions()->save(new Question([
            'question' => 'Half Empty or Half Full?'
        ]));

        // create some options
        $option1 = $question->options()->save(new Option(['value' => 'full']));
        $option2 = $question->options()->save(new Option(['value' => 'empty']));

        $this->assertEquals($question->options()->count(), 2);

        // create a submission and an answer
        $submission = $this->survey->submissions()->save(new Submission());

        $submission->answers()->save(new Answer([
            'question_id' => $question->id,
            'option_id' => $option1->id
        ]));

        $this->assertEquals($question->answers()->count(), 1);
    }

}
