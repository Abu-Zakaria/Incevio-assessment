<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => "required|email",
            'password' => "required",
        ];
    }

    public function login(): bool
    {
        if (auth()->attempt($this->only('email', 'password'))) {
            $admin = User::where('email', $this->email)->first();
            auth()->loginUsingId($admin->id);

            return true;
        }
        return false;
    }
}
