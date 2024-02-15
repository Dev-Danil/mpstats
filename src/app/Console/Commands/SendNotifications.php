<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Models\NotificationLogStatusEnum;
use App\Models\NotificationLog;
use App\Operations\Notifications\SmsNotificationIntegratorFactory;
use App\Operations\Notifications\TelegramNotificationIntegratorFactory;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class SendNotifications extends Command
{
    protected $signature = 'app:send-notifications
        {typeIntegrator : Тип интегратора}
        {--chunk-size=100 : Размер чанка}';

    protected $description = 'Отправка нотификаций по интеграторам';

    public function handle()
    {
        $type = $this->argument('typeIntegrator');
        $chunkSize = (int) $this->option('chunk-size');

        if ($type === null || !\in_array($type, [NotificationLog::TYPE_TELEGRAM, NotificationLog::TYPE_SMS])) {
            $this->error('Не указан интегратор или указан не существующий');

            return;
        }

        switch ($type) {
            case NotificationLog::TYPE_TELEGRAM:
                $notificationFactory = new TelegramNotificationIntegratorFactory();
                break;
            case NotificationLog::TYPE_SMS:
                $notificationFactory = new SmsNotificationIntegratorFactory();
                break;
        }

        $query = NotificationLog::where('type', $type)
            ->where('status', NotificationLogStatusEnum::STATUS_PENDING->value);

        $query->chunkById($chunkSize, static function (Collection $chunk) use ($notificationFactory): void {
            $now = CarbonImmutable::now();

            $chunk->each(
                static function (NotificationLog $notificationLog) use ($notificationFactory, $now): void {
                    try {
                        $result = $notificationFactory
                            ->createNotificationIntegrator()
                            ->send($notificationLog->content);

                        echo $result . ' | ';

                        $status = NotificationLogStatusEnum::STATUS_PROCESSED->value;
                    } catch (\Throwable) {
                        $status = NotificationLogStatusEnum::STATUS_ERROR->value;
                    }

                    $notificationLog->status = $status;
                    $notificationLog->processed_at = $now;
                    $notificationLog->updated_at = $now;
                    $notificationLog->save();
                }
            );
        }, 'id');
    }
}
