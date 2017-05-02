<?php

use Illuminate\Database\Seeder;
use App\Survey;
use App\Question;

class Survey1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = File::get('database/data/questions-1.json');
        $questions = json_decode($data);

        $survey = Survey::create([
            'user_id' => 1,
            'name' => "Football Teams"
        ]);

        foreach ($questions as $question) {
            $survey->questions()->create([
                'question' => $question->question,
                'options' => json_encode($question->options)
            ]);
        }

    }
}
