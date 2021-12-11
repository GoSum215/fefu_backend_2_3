<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AppealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'surname' => 'required', 'string', 'max:40',
            'name' => 'required', 'string', 'max:20',
            'patronymic' => 'nullable', 'string', 'max:20',
            'age' => 'required|integer|numeric|between:14,123',
            'gender' => 'required', Rule::in([Gender::MALE, Gender::FEMALE]),
            'phone' => 'nullable|string|regex:/^[(+7)(7)(8)]([- ()]*\d){11}$/|between:10,24',
            'email' => 'nullable|string|regex:/^[^@]+(@)[^.@]+(.)[^.@]+$/|max:100',
            'message' => 'required|string|max:100',
        ];
    }
}
