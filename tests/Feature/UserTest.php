<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_be_added()
    {
        $this->post('/users', ['name' => 'Doe', 'email' => 'John@doe.fr', 'password' => 'test']);
        $this->assertCount(1, User::all());
    }

    /** @test */
    public function a_user_can_be_deleted()
    {
        $user = User::create(['name' => 'Doe', 'email' => 'John@doe.fr', 'password' => 'test']);
        $this->delete("/users/{$user->id}");
        $this->assertCount(0, User::all());
    }
}
