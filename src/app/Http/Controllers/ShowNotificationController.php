<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

final class ShowNotificationController extends Controller
{
    public function getNotification(
        string $id
    ): JsonResponse {
        dd($id);
        //todo получение из БД по $id

        return Response::apiSuccess();
    }
}
