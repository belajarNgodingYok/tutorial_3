<?php

namespace Tests\Feature;

use Mail;
use Tests\TestCase;
use App\Mail\ConfirmYourEmail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_has_a_default_username_after__registration()
    {
        $this->post('/register', [
            'name' => 'lela li',
            'email' => 'lela@gmail.com',
            'password' => 'secret'
        ])->assertRedirect();

        $this->assertDatabaseHas('users',[            
            'username' => str_slug('lela li'),
        ]);

    }

    public function test_an_email_is_sent_to_newly_registration_users()
    {
        $this->withoutExceptionHandling();
        Mail::fake();
        //register new user
        $this->post('/register', [
            'name' => 'lela li',
            'email' => 'lela@gmail.com',
            'password' => 'secret'
        ])->assertRedirect();
        //assert that a particular email was sent
        Mail::assertSent(ConfirmYourEmail::class);
    }
}
