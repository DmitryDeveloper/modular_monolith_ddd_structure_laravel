<?php

namespace Modules\User\Application\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Application\DTOs\RegistrationData;

class UserRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:2,20',
            'email' => 'required|string|email|max:50',
            'password' => 'required|string|confirmed|min:6',
        ];
    }

    public function getDto(): RegistrationData
    {
        return new RegistrationData(
            $this->input('name'),
            $this->input('email'),
            $this->input('password')
        );
    }
}
