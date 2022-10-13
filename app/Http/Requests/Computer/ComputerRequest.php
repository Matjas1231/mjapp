<?php

namespace App\Http\Requests\Computer;

use Illuminate\Foundation\Http\FormRequest;

class ComputerRequest extends FormRequest
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
            'model' => 'string|max:100',
            'type_id' => 'integer|nullable',
            'processor' => 'string|max:60',
            'motherboard' => 'string|max:100',
            'ram' => 'string|max:200',
            'description' => 'string|nullable',
            'worker_id' => 'integer|nullable',
            'ip_address' => 'string',
            'network_name' => 'string|max:60',
            'mac_address' => 'string|max:255',
            'serial_number' => 'string|max:255|unique:computers,serial_number',
            'date_of_buy' => 'date|date_format:Y-m-d'
        ];

        if (key_exists('id', $this->validationData())) {
            $validateArray['id'] = 'integer';
            $validateArray['serial_number'] = 'string|max:255';
        }

        return $validateArray;
    }
}
