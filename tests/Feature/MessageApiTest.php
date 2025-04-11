<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class MessageApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_messages()
    {
        $user = User::factory()->create();  // 創建一個測試用戶
        $message = Message::factory()->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/messages');  // 發送 GET 請求

        $response->assertStatus(200)  // 驗證狀態碼是 200
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'content', 'user_id', 'created_at', 'updated_at'],
                ]
            ]);
    }
    public function test_create_message()
    {
        $user = User::factory()->create();  // 創建一個測試用戶

        $response = $this->actingAs($user)->postJson('/api/messages', [
            'content' => 'This is a test message',
        ]);

        $response->assertStatus(201)  // 驗證狀態碼是 201（創建成功）
            ->assertJson([
                'message' => 'Message sent successfully',
            ]);  // 驗證返回的訊息

        $this->assertDatabaseHas('messages', [
            'content' => 'This is a test message',
            'user_id' => $user->id,
        ]);  // 驗證資料庫中有這條留言
    }

    // 測試更新留言
    public function test_update_message()
    {
        $user = User::factory()->create();  // 創建一個測試用戶
        $message = Message::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->putJson("/api/messages/{$message->id}", [
            'content' => 'Updated message content',
        ]);

        $response->assertStatus(200)  // 驗證狀態碼是 200
            ->assertJson([
                'message' => 'Message updated successfully',
            ]);  // 驗證返回的訊息

        $this->assertDatabaseHas('messages', [
            'id' => $message->id,
            'content' => 'Updated message content',
        ]);  // 驗證資料庫中的留言已經被更新
    }

    // 測試刪除留言
    public function test_delete_message()
    {
        $user = User::factory()->create();  // 創建一個測試用戶
        $message = Message::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->deleteJson("/api/messages/{$message->id}");

        $response->assertStatus(200)  // 驗證狀態碼是 200
            ->assertJson([
                'message' => 'Message deleted successfully',
            ]);  // 驗證返回的訊息

        $this->assertDatabaseMissing('messages', [
            'id' => $message->id,
        ]);  // 驗證資料庫中已經沒有這條留言
    }

    // 測試未授權的更新留言
    public function test_update_message_unauthorized()
    {
        $user = User::factory()->create();  // 創建一個測試用戶
        $anotherUser = User::factory()->create();  // 創建另一個測試用戶
        $message = Message::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($anotherUser)->putJson("/api/messages/{$message->id}", [
            'content' => 'Updated by another user',
        ]);

        $response->assertStatus(403)  // 驗證狀態碼是 403（未授權）
            ->assertJson([
                'message' => 'Unauthorized',
            ]);  // 驗證返回的訊息
    }

    // 測試未授權的刪除留言
    public function test_delete_message_unauthorized()
    {
        $user = User::factory()->create();  // 創建一個測試用戶
        $anotherUser = User::factory()->create();  // 創建另一個測試用戶
        $message = Message::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($anotherUser)->deleteJson("/api/messages/{$message->id}");

        $response->assertStatus(403)  // 驗證狀態碼是 403（未授權）
            ->assertJson([
                'message' => 'Unauthorized',
            ]);  // 驗證返回的訊息
    }
}
