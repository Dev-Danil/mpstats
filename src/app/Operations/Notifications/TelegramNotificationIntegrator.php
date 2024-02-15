<?php

declare(strict_types=1);

namespace App\Operations\Notifications;

class TelegramNotificationIntegrator extends NotificationIntegrator
{
    public function send(string $message): string
    {
        //todo бизнес логика по отправке Telegram
        return 'send_tlg';
    }
}
