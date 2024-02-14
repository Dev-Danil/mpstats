<?php

declare(strict_types=1);

namespace App\Providers\Operations;

use App\Enums\Models\NotificationLogStatusEnum;
use App\Exceptions\BadStatusNotificationException;
use App\Exceptions\NotificationNotFoundException;
use Carbon\CarbonImmutable;

class NotificationLogsOperation
{
    public function __construct(
        private readonly NotificationLogsDataProvider $notificationLogsDataProvider,
    ) {}

    public function updateNotificationLogById(int $id, string $content): void
    {
        $notification = $this
            ->notificationLogsDataProvider
            ->getNotificationLogById($id);

        if ($notification === null) {
            throw new NotificationNotFoundException('Notification with this ID not found');
        }

        if ($notification->status !== NotificationLogStatusEnum::STATUS_PENDING->value) {
            throw new BadStatusNotificationException('You cannot change the message in this status');
        }

        $notification->content = $content;
        $notification->updated_at = CarbonImmutable::now();
        $notification->save();
    }

    public function deleteNotificationLogById(int $id): void
    {
        $notification = $this
            ->notificationLogsDataProvider
            ->getNotificationLogById($id);

        if ($notification === null) {
            throw new NotificationNotFoundException('Notification with this ID not found');
        }

        if ($notification->status === NotificationLogStatusEnum::STATUS_CANCELED->value) {
            throw new BadStatusNotificationException('The notification has already been deleted');
        }

        $now = CarbonImmutable::now();

        $notification->status = NotificationLogStatusEnum::STATUS_CANCELED->value;
        $notification->processed_at = $now;
        $notification->updated_at = $now;
        $notification->save();
    }
}
