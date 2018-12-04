<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
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
}
