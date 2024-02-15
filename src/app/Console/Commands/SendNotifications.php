<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Models\NotificationLogStatusEnum;
use App\Enums\Models\NotificationLogTypeEnum;
use App\Models\NotificationLog;
use App\Operations\Notifications\NotificationIntegratorFactory;
use App\Providers\Operations\NotificationLogsRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class SendNotifications extends Command
{
    protected $signature = 'app:send-notifications
        {typeIntegrator? : Тип интегратора}
        {--chunk-size=100 : Размер чанка}';

    protected $description = 'Отправка нотификаций по интеграторам.
    Команда php artisan app:send-notifications разошлет сообщения по всем интеграторам.';

    protected NotificationLogsRepository $notificationLogsRepository;

    public function handle(NotificationLogsRepository $notificationLogsRepository): void
    {
        $this->notificationLogsRepository = $notificationLogsRepository;

        $type = $this->argument('typeIntegrator');
        $chunkSize = (int) $this->option('chunk-size');

        $types = [$type];
        if ($type === null) {
            $types = array_column(NotificationLogTypeEnum::cases(), 'value');
        }

        $query = NotificationLog::whereIn('type', $types)
            ->where('status', NotificationLogStatusEnum::STATUS_PENDING->value);

        $query->chunkById($chunkSize, function (Collection $chunk): void {
            $chunk->each(
                function (NotificationLog $notificationLog): void {
                    try {
                        $notificationFactory = new NotificationIntegratorFactory();
                        $result = $notificationFactory
                            ->getIntergator($notificationLog->type)
                            ->send($notificationLog->content);

                        //Добавлен вывод в консоль для визуального понимания отправки sms или telegram сообщений.
                        //При работе Command в кроне (Kernel) данный вывод не нужен.
                        $this->info($result);

                        $status = NotificationLogStatusEnum::STATUS_PROCESSED;
                    } catch (\Throwable) {
                        $status = NotificationLogStatusEnum::STATUS_ERROR;
                    }

                    $this->notificationLogsRepository->setStatusNotificationLog($notificationLog, $status);
                }
            );
        }, 'id');
    }
}
