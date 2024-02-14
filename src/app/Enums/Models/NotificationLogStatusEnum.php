<?php

namespace App\Enums\Models;

enum NotificationLogStatusEnum: string
{
    case STATUS_PENDING = 'pending';
    case STATUS_PROCESSED = 'processed';
    case STATUS_ERROR = 'error';
    case STATUS_CANCELED = 'canceled';
}
