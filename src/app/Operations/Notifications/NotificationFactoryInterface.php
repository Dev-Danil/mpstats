<?php

declare(strict_types=1);

namespace App\Operations\Notifications;

interface NotificationFactoryInterface
{
    public function createNotificationIntegrator(): NotificationIntegratorInterface;
}
