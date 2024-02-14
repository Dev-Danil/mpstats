<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ApiNotFoundException;
use App\Exceptions\InternalServerErrorException;
use App\Http\Requests\CreateNotificationPostRequest;
use App\Models\NotificationLog;
use App\Providers\Operations\NotificationLogsDataProvider;
use Illuminate\Http\JsonResponse;

class CreateNotificationController extends Controller
{
    public function createNotification(
        CreateNotificationPostRequest $request,
        NotificationLogsDataProvider $notificationLogsDataProvider
    ): JsonResponse {
        if (\in_array($request->getBodyType(), [NotificationLog::TYPE_SMS, NotificationLog::TYPE_TELEGRAM]) === false) {
            throw new ApiNotFoundException(
                'This type is not contained in the application',
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        try {
            $notificationLogsDataProvider->saveNotificationLog($request->getBodyContent(), $request->getBodyType());
        } catch (\Throwable $exception) {
            throw new InternalServerErrorException('Failed to create notification');
        }

        return new JsonResponse($request->toArray(), JsonResponse::HTTP_OK);
    }
}
