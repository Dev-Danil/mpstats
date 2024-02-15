<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @summary Обновление нотификации
 * @property-read string $content Контент сообщения
 * @property-read int $id ID нотификации
 */
class UpdateNotificationPatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
            'id' => ['required', 'integer'],
        ];
    }
}
