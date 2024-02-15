<?php

declare(strict_types=1);

namespace App\Operations\Notifications;

class SmsNotificationIntegrator implements NotificationIntegratorInterface
{
    public function send(string $message): string
    {
        //todo бизнес логика по отправке Sms
        return 'send_sms';
    }
}
