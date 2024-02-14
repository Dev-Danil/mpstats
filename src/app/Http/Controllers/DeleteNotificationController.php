<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ApiNotFoundException;
use App\Exceptions\BadStatusNotificationException;
use App\Exceptions\InternalServerErrorException;
use App\Exceptions\NotificationNotFoundException;
use App\Providers\Operations\NotificationLogsOperation;
use Illuminate\Http\JsonResponse;

class DeleteNotificationController extends Controller
{
    public function deleteNotification(
        int $id,
        NotificationLogsOperation $notificationLogsOperation
    ): JsonResponse {
        try {
            $notificationLogsOperation
                ->deleteNotificationLogById($id);
        } catch (NotificationNotFoundException|BadStatusNotificationException $exception) {
            throw new ApiNotFoundException('Failed to delete notification');
        } catch (\Throwable $exception) {
            throw new InternalServerErrorException('Failed to delete notification');
        }

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }
}
