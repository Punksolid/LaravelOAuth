<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;

class GetAccessTokenTest extends TestCase
{

    public function testCanGenerateUserAccessToken(): void
    {
        /**
         * user_id 1
         * Client ID: 6
         * Client secret: NrubtjG78JE9iGVNCTMlmFAWWGXLQpmOYBW4Nqyt
         */
        $response = $this->postJson('/api/get_access_token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => 'the-refresh-token',
            'client_id' => 'client-id',
            'client_secret' => 'client-secret',
            'scope' => '',
        ]);

        $response->dump();
        $response->assertStatus(200);
    }

    public function testGetClientAppAccessToken(): void
    {
        $response = $this->postJson('oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => 3,
            'client_secret' => 'CeD93FZt5NLTRz2cJdVEWDAqxR0jBnoLBIwIg4Bx',
            'scope' => ''
        ]);

//        $response->dump();
        $response->assertJsonStructure([
            'token_type',
            'expires_in',
            'access_token'
        ]);
    }

    public function testCanAccessWithUserClientAppAccessToken(): void
    {
        $this->withoutExceptionHandling();
        /** @var Task $task */
        $task = factory(Task::class)->create();

        $app_access_token = $this->getAppAccessToken();
//        dump($app_access_token);
        $user_access_token = $this->postJson('api/get_access_token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => 'the-refresh-token',
            'client_id' => '3',
            'client_secret' => 'CeD93FZt5NLTRz2cJdVEWDAqxR0jBnoLBIwIg4Bx',
            'scope' => '',
        ], [
            'Authorization' => 'Bearer '. $app_access_token
        ]);
        dump($user_access_token);

        $response = $this->getJson('api/tasks', [
            'Authorization' => 'Bearer '. $user_access_token
        ]);

//        $response->dump();
        $response->assertJson([
            $task->toArray()
        ]);
    }

    private function getAppAccessToken()
    {
        $response = $this->postJson('oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => 3,
            'client_secret' => 'CeD93FZt5NLTRz2cJdVEWDAqxR0jBnoLBIwIg4Bx',
            'scope' => ''
        ]);
//        $response->dump();

        return json_decode($response->getContent())->access_token;
    }
}
