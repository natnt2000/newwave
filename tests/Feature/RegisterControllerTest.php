<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegister()
    {
        Event::fake();
        $response = $this->post('/register', [
            'name' => 'Pham Ngoc Anh',
            'email' => 'ngocanhphamk99@gmail.com',
            'password' => '123@newwave'
        ]);

        $response->assertStatus(200);
    }
}
