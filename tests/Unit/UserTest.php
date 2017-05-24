<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

Use App\User;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_register()
    {

        $user = [
            'name' => 'Joe Smith',
            'email' => 'joesmith@aol.com',
            'slug' => 'joes-surveys',
            'password' => 'supasecret',
            'password_confirmation' => 'supasecret'
        ];

        $this->post('/register', $user);
        $checkUser = User::where('email', 'joesmith@aol.com')->first();

        $this->assertEquals($checkUser->name, $user["name"]);
        $this->assertEquals($checkUser->email, $user["email"]);
        $this->assertEquals($checkUser->slug, $user["slug"]);

    }

}
