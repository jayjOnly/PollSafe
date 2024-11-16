<?php

namespace App\Http\Requests\organizationMember;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EditRoleOrganizationMemberRequest extends FormRequest
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
            'user_id' => ['required', 'string'],
            'role' => ['required', 'integer']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
