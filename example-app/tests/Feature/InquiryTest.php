<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InquiryTest extends TestCase
{
    // 送信確認テスト
    public function test_inquiry_can_be_created(): void
    {
        $response = $this->get('/contact', [
            'first_name' => 'Yamada',
            'last_name' => 'Taro',
            'corp_name' => 'Example Corp',
            'email' => 'yamada@example.com',
            'content' => 'This is a test inquiry.',
        ]);

        $response->assertRedirect(route('contact.index'));

        $this->assertDataBaseHas('inquiries',[
            'email' => 'yamada@example.com',
        ]);
    }
}
