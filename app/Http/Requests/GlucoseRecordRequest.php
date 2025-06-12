<?php

namespace App\Http\Requests;

use App\Enums\MeasurementPoint;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GlucoseRecordRequest extends FormRequest
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
            'glucose' => ['required', 'numeric', 'between:1,999.99'],
            'weight' => ['nullable', 'numeric', 'between:1,999.99'],
            'measurement_point' => ['required', Rule::enum(MeasurementPoint::class)]
        ];
    }

    public function messages()
    {
        return [
            'glucose.required' => 'Chỉ số đường huyết là trường bắt buộc',
            'glucose.numeric' => 'Chỉ số đường huyết phải là một số',
            'glucose.between' => 'Chỉ số đường huyết không hợp lệ',
            'weight.numeric' => 'Cân nặng phải là một số',
            'weight.between' => 'Cân nặng không hợp lệ',
            'measurement_point.required' => 'Thời điểm đo là trường bắt buộc',
            'measurement_point.enum' => 'Thời điểm đo không hợp lệ'
        ];
    }
}
