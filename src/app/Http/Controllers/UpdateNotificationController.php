<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Models\NotificationLogStatusEnum;
use App\Exceptions\BadStatusNotificationException;
use App\Exceptions\NotificationNotFoundException;
use App\Http\Requests\UpdateNotificationPatchRequest;
use App\Providers\Operations\NotificationLogsRepository;
use Illuminate\Http\Response;

class UpdateNotificationController extends Controller
{
    public function updateNotification(
        UpdateNotificationPatchRequest $request,
        NotificationLogsRepository $notificationLogsRepository
    ): Response {
        $notification = $notificationLogsRepository->getNotificationLogById((int) $request->id);

        if ($notification === null) {
            throw new NotificationNotFoundException('Notification with this ID not found');
        }

        if ($notification->status !== NotificationLogStatusEnum::STATUS_PENDING->value) {
            throw new BadStatusNotificationException('You cannot change the message in this status');
        }

        $notificationLogsRepository->updateContentNotificationLog($notification, $request->content);

        return response()->noContent();
    }
}
