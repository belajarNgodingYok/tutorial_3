<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConfirmEmailTest extends TestCase
{
    use RefreshDatabase;
   public function test_a_user_can_confirm_email()
   {
        $this->withoutExceptionHandling();
       //create user
       //make get request to the confirm endpoint
       //assert that the user confirmed
       $user = factory(User::class)->create();
        // dd($user);
       $this->get("/register/confirm/?token={$user->confirm_token}")
       ->assertRedirect('/');
       $this->assertTrue($user->fresh()->isConfirmed());
   }
}
