<?php

declare(strict_types=1);

namespace App\Operations\Notifications;

use App\Exceptions\BusinessLogicException;

class NotificationIntegratorAbstractFactory
{
    public function getIntergator(string $type)
    {
        switch ($type) {
            case 'sms':
                return new SmsNotificationIntegrator();
            case 'telegram':
                return new TelegramNotificationIntegrator();
            default:
                throw new BusinessLogicException('Integrator does not exist');
        }
    }
}
