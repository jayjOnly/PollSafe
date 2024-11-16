<?php

namespace App\Http\Requests\organization;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EditOrganizationRequest extends FormRequest
{
    public $validator = null;
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'organization_id' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
