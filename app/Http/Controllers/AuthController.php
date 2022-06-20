<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = $request->findUser();

        if (!$user || !Hash::check($request->password, $user->password)) {
            abort(Response::HTTP_UNAUTHORIZED, __('The provided credentials are incorrect.'));
        }

        return $request->issueAccessToken($user);
    }

    public function logout(LogoutRequest $request)
    {
        $request->logout();
        return ['message' => __('Logout successfully.')];
    }
}
