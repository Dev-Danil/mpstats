<?php

declare(strict_types=1);

namespace App\Operations\Notifications;

class SmsNotificationIntegratorFactory implements NotificationFactoryInterface
{
    public function createNotificationIntegrator(): NotificationIntegratorInterface
    {
        return new SmsNotificationIntegrator();
    }
}
