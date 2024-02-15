<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Models\NotificationLogStatusEnum;
use App\Exceptions\BadStatusNotificationException;
use App\Exceptions\NotificationNotFoundException;
use App\Providers\Operations\NotificationLogsRepository;
use Illuminate\Http\Response;

class DeleteNotificationController extends Controller
{
    public function deleteNotification(
        int $id,
        NotificationLogsRepository $notificationLogsRepository,
    ): Response {
        $notification = $notificationLogsRepository->getNotificationLogById($id);

        if ($notification === null) {
            throw new NotificationNotFoundException('Notification with this ID not found');
        }

        if ($notification->status === NotificationLogStatusEnum::STATUS_CANCELED->value) {
            throw new BadStatusNotificationException('The notification has already been deleted');
        }

        $notificationLogsRepository->setStatusNotificationLog(
            $notification,
            NotificationLogStatusEnum::STATUS_CANCELED
        );

        return response()->noContent();
    }
}
