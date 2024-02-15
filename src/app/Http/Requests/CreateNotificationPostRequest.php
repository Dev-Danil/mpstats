<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Models\NotificationLogTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @summary Создание нотификации
 * @property-read string $content Контент сообщения
 * @property-read string $type Тип интегратора
 */
class CreateNotificationPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
            'type' => ['required', Rule::enum(NotificationLogTypeEnum::class)
            ],
        ];
    }
}
