<?php

use Illuminate\Database\Seeder;
use App\Survey;
use App\Questions;

class Patriots1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = File::get('database/data/patriots.json');
        $questions = json_decode($data);

        $survey = Survey::create([
            'user_id' => 1,
            'name' => "Patriots Survey"
        ]);

        foreach ($questions as $question) {
            $survey->questions()->create([
                'question' => $question->question,
                'options' => json_encode($question->options)
            ]);
        }

    }
}
