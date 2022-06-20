<?php

namespace App\Http\Requests\Peripheral;

use Illuminate\Foundation\Http\FormRequest;

class PeripheralRequest extends FormRequest
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
            'brand' => 'string|max:60',
            'model' => 'string|max:100|nullable',
            'serial_number' => 'string|max:100|nullable|unique:peripherals,serial_number',
            'ip_address' => 'string|nullable',
            'mac_address' => 'string|nullable',
            'network_name' => 'string|nullable',
            'type_id' => 'integer|nullable',
            'description' => 'string|nullable',
            'worker_id' => 'integer|nullable',
            'date_of_buy' => 'date|date_format:Y-m-d',
        ];

        if (key_exists('id', $this->validationData())) {
            $validateArray['id'] = 'integer';
            $validateArray['serial_number'] = 'string|max:100|nullable';
        }

        return $validateArray;
    }
}
