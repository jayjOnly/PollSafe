<?php

namespace App\Http\Requests\voting;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SetVoteRequest extends FormRequest
{
    public $validator = null;
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'organization_vote_id' => ['required', 'string'],
            'candidate_id' => ['required', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
