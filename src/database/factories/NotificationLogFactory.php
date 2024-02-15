<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Models\NotificationLogStatusEnum;
use App\Enums\Models\NotificationLogTypeEnum;
use App\Models\NotificationLog;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotificationLog>
 */
class NotificationLogFactory extends Factory
{
    protected $model = NotificationLog::class;

    public function definition(): array
    {
        $now = CarbonImmutable::parse($this->faker->date());

        return [
            'content' => 'text_content',
            'type' => NotificationLogTypeEnum::TYPE_SMS->value,
            'status' => NotificationLogStatusEnum::STATUS_PENDING->value,
            'processed_at' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }
}
