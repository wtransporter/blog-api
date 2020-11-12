<?php

use App\Models\User;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function signIn(User $user = NULL)
    {
        $loggedInUser =  $user ?? User::factory()->create();
        
        $this->actingAs($loggedInUser);
        
        return $this;
    }
}
