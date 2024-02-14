<?php

declare(strict_types=1);

namespace App\Providers\Operations;

use App\Enums\Models\NotificationLogStatusEnum;
use App\Models\NotificationLog;
use Carbon\CarbonImmutable;

class NotificationLogsDataProvider
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
        $notificationLog->status = NotificationLogStatusEnum::STATUS_PENDING;
        $notificationLog->processed_at = null;
        $notificationLog->created_at = $now;
        $notificationLog->updated_at = $now;

        $notificationLog->save();

        return $notificationLog;
    }
}
