<?php

namespace App\Http\Requests\Software;

use Illuminate\Foundation\Http\FormRequest;

class SoftwareRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $validateArray = [
        'producer' => 'string|max:50',
        'name' => 'string|max:60',
        'serial_number' => 'string|max:150|unique:softwares,serial_number',
        'worker_id' => 'integer|nullable',
        'description' => 'string|nullable',
        'date_of_buy' => 'date|date_format:Y-m-d',
        'expiry_date' => 'date|date_format:Y-m-d',
        ];

        if (key_exists('id', $this->validationData())) {
            $validateArray['id'] = 'integer';
            $validateArray['serial_number'] = 'string|max:150';
        }

        return $validateArray;
    }
}
