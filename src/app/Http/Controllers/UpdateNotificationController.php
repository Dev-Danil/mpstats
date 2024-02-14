<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ApiNotFoundException;
use App\Exceptions\BadStatusNotificationException;
use App\Exceptions\InternalServerErrorException;
use App\Exceptions\NotificationNotFoundException;
use App\Http\Requests\UpdateNotificationPatchRequest;
use App\Providers\Operations\NotificationLogsOperation;
use Illuminate\Http\JsonResponse;

class UpdateNotificationController extends Controller
{
    public function updateNotification(
        UpdateNotificationPatchRequest $request,
        NotificationLogsOperation $notificationLogsOperation
    ): JsonResponse {
        try {
            $notificationLogsOperation
                ->updateNotificationLogById(
                    $request->getBodyId(),
                    $request->getBodyContent()
                );
        } catch (NotificationNotFoundException|BadStatusNotificationException $exception) {
            throw new ApiNotFoundException('Failed to update notification');
        } catch (\Throwable $exception) {
            throw new InternalServerErrorException('Failed to create notification');
        }

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }
}
