<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\NotificationLog;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UpdateNotificationControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Положительный тест endpoint api/get_notification
     * @return void
     */
    public function testGetNotification(): void
    {
        $notificationLogFactory = NotificationLog::factory()->create();
        $response = $this->get("api/get_notification/{$notificationLogFactory->id}");

        $response->assertStatus(200);
        $response->assertContent(NotificationLog::where('id', $notificationLogFactory->id)->first()->toJson());
    }

    /**
     * Положительный тест endpoint api/create_notification
     * @todo Можно добавить NotificationLogsDto для удобной работы с данными
     * @return void
     */
    public function testCreateNotification(): void
    {
        $content = 'content_content_test';
        $type = 'telegram';

        $response = $this->post('api/create_notification', [
            'content' => $content,
            'type' => $type,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('notification_logs', [
            'content' => $content,
            'type' => $type,
        ]);
    }
}
