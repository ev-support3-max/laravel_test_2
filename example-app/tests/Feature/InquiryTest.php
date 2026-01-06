<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Inquiry;
use App\Models\User;

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

    public function test_inquiry_validation_errors()
    {
        $response = $this->post(route('contact.store'), [
            'first_name' => '山田',
            'last_name' => '太郎',
            'corp_name' => '例株式会社',
            'email' => 'test',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseCount('inquiries', 0);
    }

    public function test_inquiry_fails_when_name_is_long()
    {
        $response = $this->post(route('contact.store'),[
            'first_name' => str_repeat('a', 300),
            'last_name' => str_repeat('b', 300),
            'email' => 'test@example.com',
            'content' => 'This is a test inquiry.',
        ]);

        $response->assertSessionHasErrors(['first_name', 'last_name']);
    }

    public function test_gest_connot_access_admin()
    {
        $response = $this->get('/admin/inquiries');
        $response->assertRedirect('/admin/login');
    }

    // public function test_admin_can_access_inquiries()
    // {
    //     $user = User::factory()->create();

    //     $response = $this->actingAs($user)->get('/admin/inquiries');
    //     $response->assertStatus(200);
    // }

    // public function test_api_create_inquiry()
    // {
    //     $response = $this->postJson('/api/inquiries', [
    //         'first_name' => 'Yamada',
    //         'last_name' => 'Taro',
    //         'corp_name' => 'Example Corp',
    //         'email' => 'yamada@example.com',
    //     ]);
    //     $response->assertStatus(201)
    //              ->assertJson(['message' => 'Inquiry created API successfully.']);
    // }
}