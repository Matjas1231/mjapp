<?php

namespace App\Http\Requests\Worker;

use Illuminate\Foundation\Http\FormRequest;

class WorkerRequest extends FormRequest
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
            'name' => 'string|max:50',
            'surname' => 'string|max:60',
            'position' => 'string|max:60',
            'department_id' => 'integer|nullable',
            'phone' => 'string|24',
        ];

        if (key_exists('id', $this->validationData())) {
            $validateArray['id'] = 'integer';
        }

        return $validateArray;
    }
}
