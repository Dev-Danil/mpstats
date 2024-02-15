<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Console\Commands\SendNotifications;
use App\Enums\Models\NotificationLogStatusEnum;
use App\Enums\Models\NotificationLogTypeEnum;
use App\Models\NotificationLog;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SendNotificationsTest extends TestCase
{
    use DatabaseTransactions;

    public function testOk(): void
    {
        $notificationLogFactory = NotificationLog::factory()->create();
        $this->artisan(SendNotifications::class);

        $this->assertDatabaseHas('notification_logs', [
            'id' => $notificationLogFactory->id,
            'content' => $notificationLogFactory->content,
            'type' => NotificationLogTypeEnum::TYPE_SMS->value,
            'status' => NotificationLogStatusEnum::STATUS_PROCESSED->value
        ]);
    }
}
