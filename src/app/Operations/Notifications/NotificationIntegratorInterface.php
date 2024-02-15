<?php

declare(strict_types=1);

namespace App\Operations\Notifications;

interface NotificationIntegratorInterface
{
    public function send(string $message);
}
