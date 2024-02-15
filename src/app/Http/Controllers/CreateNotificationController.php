<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateNotificationPostRequest;
use App\Providers\Operations\NotificationLogsRepository;
use Illuminate\Http\JsonResponse;

class CreateNotificationController extends Controller
{
    public function createNotification(
        CreateNotificationPostRequest $request,
        NotificationLogsRepository $notificationLogsRepository
    ): JsonResponse {
        return response()->json($notificationLogsRepository->saveNotificationLog($request->content, $request->type));
    }
}
