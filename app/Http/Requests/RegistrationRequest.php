<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  // Set this to "true" else Unauthorized error will be thrown
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'    => ['required', 'min:3'],
            'last_name'     => ['required', 'min:3'],
            'username'      => ['required', 'min:3'],
            'email'         => ['required', 'string', 'email'],
            'password'      => ['required', 'string', 'min:6'],
            'computername'  => ['string', 'min:6'],
            'volume_label'  => ['string', 'min:3'],
            'ac_level'      => ['integer', 'min:1'],
            'active'        => ['boolean'],
        ];
    }
}
