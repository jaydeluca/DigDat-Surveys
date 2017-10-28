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
      	$files = ['database/data/survey-football-1.json',
                  'database/data/survey-patriots.json'
                 ];
      	foreach($files as $file) {
      		$data = File::get($file);
      		$survey_seed = collect(json_decode($data))[0];

      		$survey = Survey::create([
      		    'user_id' => 1,
      		    'name' => $survey_seed->name,
              'description' => $survey_seed->description
      		]);

      		foreach ($survey_seed->questions as $question) {
      		     $new_question = $survey->questions()->create([
      			     'question' => $question->question,
      		    ]);

      		    foreach ($question->options as $option) {
            			$new_question->options()->create([
                      'label' => $option,
            			    'value' => $option
            			]);
    		      }
      		}
      	}
    }
}
