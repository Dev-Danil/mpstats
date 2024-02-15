<?php

declare(strict_types=1);

namespace App\Providers\Operations;

use App\Enums\Models\NotificationLogStatusEnum;
use App\Models\NotificationLog;
use Carbon\CarbonImmutable;

class NotificationLogsRepository
{
    public function getNotificationLogById(int $id): ?NotificationLog
    {
        return NotificationLog::where('id', $id)
            ->first();
    }

    public function saveNotificationLog(
        string $content,
        string $type,
    ): NotificationLog {
        $notificationLog = new NotificationLog();
        $now = CarbonImmutable::now();

        $notificationLog->content = $content;
        $notificationLog->type = $type;
        $notificationLog->status = NotificationLogStatusEnum::STATUS_PENDING->value;
        $notificationLog->processed_at = null;
        $notificationLog->created_at = $now;
        $notificationLog->updated_at = $now;

        $notificationLog->save();

        return $notificationLog;
    }

    public function setStatusNotificationLog(NotificationLog $notification, NotificationLogStatusEnum $status): void
    {
        $now = CarbonImmutable::now();

        $notification->status = $status->value;
        $notification->processed_at = $now;
        $notification->updated_at = $now;
        $notification->save();
    }

    public function updateContentNotificationLog(NotificationLog $notification, string $content): void
    {
        $notification->content = $content;
        $notification->updated_at = CarbonImmutable::now();
        $notification->save();
    }
}
