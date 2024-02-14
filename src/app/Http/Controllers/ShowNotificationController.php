<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ApiNotFoundException;
use App\Providers\Operations\NotificationLogsDataProvider;
use Illuminate\Http\JsonResponse;

class ShowNotificationController extends Controller
{
    public function getNotification(
        int $id,
        NotificationLogsDataProvider $notificationLogsDataProvider
    ): JsonResponse {
        $notificationLog = $notificationLogsDataProvider
            ->getNotificationLogById($id);

        if ($notificationLog === null) {
            throw new ApiNotFoundException("Notification with this ID not found");
        }

        return new JsonResponse($notificationLog->toArray(), JsonResponse::HTTP_OK);
    }
}
