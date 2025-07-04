<?php

namespace App\Http\Requests;

use App\Enums\GlucoseStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GlucoseRecordFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'dateFrom' => ['nullable', 'date:mm/dd/YYYY', 'before_or_equal:dateTo', 'required_with:dateTo'],
            'dateTo' => ['nullable', 'date:mm/dd/YYYY', 'required_with:dateFrom'],
            'status' => ['nullable', Rule::isEnum(GlucoseStatus::class)]
        ];
    }

    protected function failedValidation(Validator $validator) {}
}
