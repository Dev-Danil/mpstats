<?php

namespace App\Enums\Models;

enum NotificationLogTypeEnum: string
{
    case TYPE_SMS = 'sms';
    case TYPE_TELEGRAM = 'telegram';
}
