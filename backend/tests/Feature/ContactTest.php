<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    
    // API送信確認テスト
    public function test_api_can_create_contact(): void
    {
        $this->withoutExceptionHandling();
        {
            $response = $this->postJson('/api/contact', [
                'first_name' => 'Yamada',
                'last_name' => 'Taro',
                'corp_name' => 'Example Corp',
                'email' => 'yamada@example.com',
                'content' => 'This is a test contact.',
            ]);

            // 201（作成成功）
            $response->assertStatus(201);

            $this->assertDatabaseHas('contacts',[
                'email' => 'yamada@example.com',
            ]);
        }
    }

    public function test_api_validation_error()
    {
        $response = $this->postJson('/api/contact', []);

        $response->assertStatus(422)
                 // ▼【修正2】'contact' ではなく 'content' が正しいはず
                 ->assertJsonValidationErrors(['first_name', 'email', 'content']);
    }
}