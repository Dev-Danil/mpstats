<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'content' => 'required|string',
            'type' => 'required|string',
        ];
    }

    public function getBodyContent(): string
    {
        return $this->input('content');
    }

    public function getBodyType(): string
    {
        return $this->input('type');
    }
}
