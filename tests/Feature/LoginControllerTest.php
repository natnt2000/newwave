<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin()
    {
        Event::fake();
        $user = factory(User::class)->create(['role' => rand(0, 1)]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '123@newwave'
        ]);

        if ($user->role === 0) {
            $response->assertRedirect('/profile');
        }

        if ($user->role === 1) {
            $response->assertRedirect('/admin');
        }
    }
}
