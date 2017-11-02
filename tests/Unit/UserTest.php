<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Validation\ValidationException;

use App\User;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    private $user = [
        'name' => 'Joe Smith',
        'email' => 'joesmith@aol.com',
        'slug' => 'joes-surveys',
        'password' => 'supasecret',
        'password_confirmation' => 'supasecret'
    ];


    /** @test */
    public function a_user_can_register()
    {
        $this->post('/register', $this->user);
        $checkUser = User::where('email', 'joesmith@aol.com')->first();

        $this->assertEquals($checkUser->name, $this->user["name"]);
        $this->assertEquals($checkUser->email, $this->user["email"]);
        $this->assertEquals($checkUser->slug, $this->user["slug"]);
    }

    /** @test **/
    public function unique_user_email()
    {
        $resp = $this->post('/register', $this->user);

        //we want a new slug, but dupe'd email
        $this->user['slug'] = 'blah';
        $this->unique_fields('email');
    }

    /** @test **/
    public function unique_user_slug()
    {
        $resp = $this->post('/register', $this->user);

        //we want a new email, but dupe'd slug
        $this->user['email'] = 'bob@test.com';
        $this->unique_fields('slug');
    }

    private function unique_fields($field)
    {
        $this->logout();
        try {
            $this->post('/register', $this->user);
        } catch(ValidationException $e){
            $msgs = $e->validator->getMessageBag()->messages();
            $keys = array_keys($msgs);
            $this->assertEquals(sizeof($keys), 1);
            $this->assertEquals($keys[0], $field);
        }
    }

    private function logout()
    {
        $this->post('/logout',['_token'=>\Session::token()]);
    }

}
