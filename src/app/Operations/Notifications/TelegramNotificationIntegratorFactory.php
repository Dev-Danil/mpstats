<?php

declare(strict_types=1);

namespace App\Operations\Notifications;

class TelegramNotificationIntegratorFactory implements NotificationFactoryInterface
{
    public function createNotificationIntegrator(): NotificationIntegratorInterface
    {
        return new TelegramNotificationIntegrator();
    }
}
