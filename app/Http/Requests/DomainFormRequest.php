<?php

namespace AbuseIO\Http\Requests;

use AbuseIO\Http\Requests\Request;

class DomainFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        $domain = new Domain();

        switch ($this->method) {
            case 'POST':
                return $domain->createRules($this);
            case 'PUT':
            case 'PATCH':
                return $domain->updateRules($this);
            default:
                break;
        }
    }
}
