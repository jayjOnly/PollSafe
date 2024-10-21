<?php

namespace App\Http\Requests;

class UpdateOrganizationRequest extends StoreOrganizationRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->organization);
    }
}
