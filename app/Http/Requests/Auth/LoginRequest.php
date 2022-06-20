<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'string|required',
            'password' => 'string|required',
        ];
    }

    public function issueAccessToken(User $user)
    {
        $token = $user->createToken($this->device_name)->plainTextToken;
        return ['access_token' => $token, 'type' => 'Bearer'];
    }

    public function findUser()
    {
        $username = $this->username;
        return User::where('username', $username)
            ->orWhere('email', $username)->first();
    }
}
