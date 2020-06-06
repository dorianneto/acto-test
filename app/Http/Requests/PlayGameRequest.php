<?php

namespace App\Http\Requests;

use App\Rules\HandChecker;
use Illuminate\Foundation\Http\FormRequest;

class PlayGameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|max:100|required',
            'hand' => ['array', 'required', new HandChecker],
        ];
    }
}
