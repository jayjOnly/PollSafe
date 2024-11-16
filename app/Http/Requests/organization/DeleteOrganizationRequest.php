<?php

namespace App\Http\Requests\organization;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DeleteOrganizationRequest extends FormRequest
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
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
