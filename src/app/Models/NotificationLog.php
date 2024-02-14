<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $content
 * @property string $type
 * @property string $status
 * @property Carbon|null $processed_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class NotificationLog extends Model
{
    use HasFactory;

    final public const TYPE_SMS = 'sms';
    final public const TYPE_TELEGRAM = 'telegram';

    protected $casts = [
        'processed_at' => 'datetime',
    ];
}
