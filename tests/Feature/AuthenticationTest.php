<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
//    /**
//     *
//     * @test
//     * @throws \JsonException
//     */
//    public function a_user_can_authenticate_with_email_and_correct_password(): void
//    {
//        $user = User::factory()->create();
//        $response = $this->post('/api/login',['email' => $user->email,'password' =>'password']);
//        $response->assertOk();
//        $this->assertAuthenticated();
//        $response->assertSee(['token' => $user->tokens->last()->plainTextToken]);
//    }
//
//
//    /**
//     *
//     * @test
//     * @throws \JsonException
//     */
//    public function a_user_cannot_authenticate_with_wrong_email_or_password(): void
//    {
//        $user = User::factory()->create();
//        $response = $this->post('/api/login',['email' => $user->email,'password' =>'wrong-password'], ['accept' => 'application/json']);
//        $response->assertUnprocessable();
//        $response = $this->post('/api/login',['email' => 'wrongtest@email.com','password' =>'password'], ['accept' => 'application/json']);
//        $response->assertUnprocessable();
//        $this->assertGuest();
//
//    }
}
