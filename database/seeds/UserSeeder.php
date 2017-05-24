<?php

use Illuminate\Database\Seeder;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();

        User::create([
            'name' => 'Jay',
            'email' => 'jay@test.com',
            'slug' => 'jay-surveys',
            'password' => bcrypt('secret')
        ]);

    }
}
