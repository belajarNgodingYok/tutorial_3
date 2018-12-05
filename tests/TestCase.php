<?php

namespace Tests;

use Config;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public function loginAdmin()
    {
        $user = factory(User::class)->create();

        Config::push('tutorial.administrators', $user->email);
        
        $this->actingAs($user);
    }
}
