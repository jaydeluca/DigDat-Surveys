<?php

use Illuminate\Database\Seeder;
use App\Survey;
use App\Question;
use App\Option;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Survey::truncate();
        Question::truncate();
        Option::truncate();

        $data = File::get('database/data/questions-1.json');
        $questions = collect(json_decode($data));

        $survey = Survey::create([
            'user_id' => 1,
            'name' => "Football Teamss"
        ]);

        foreach ($questions as $question) {
             $question = $survey->questions()->create([
                'question' => $question->question,
            ]);

             print_r(collect($question->options));

//             $question->options()->create([
//                 'value' => $option
//             ]);

//            foreach ($question->options as $option) {
//                Option::create([
//                    'question_id' => $question->id,
//                    'value' => $option
//                ]);
//            }
        }

    }
}
