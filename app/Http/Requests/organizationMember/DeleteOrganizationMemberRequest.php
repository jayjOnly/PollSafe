<?php

namespace App\Http\Requests\organizationMember;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DeleteOrganizationMemberRequest extends FormRequest
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
            'member_id' => ['required', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
