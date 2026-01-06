<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Inquiry;

class InquiryTest extends TestCase
{
    use RefreshDatabase;
    
    // 送信確認テスト
    public function test_inquiry_can_be_created(): void
    {
        $this->withoutExceptionHandling();
        {
            $response = $this->post(route('contact.store'), [
                'first_name' => 'Yamada',
                'last_name' => 'Taro',
                'corp_name' => 'Example Corp',
                'email' => 'yamada@example.com',
                'content' => 'This is a test inquiry.',
            ]);

            $response->assertRedirect(route('contact.index'));

            $this->assertDatabaseHas('inquiries',[
                'email' => 'yamada@example.com',
            ]);
        }
    }
}