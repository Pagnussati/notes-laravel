<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        // Form Validation
        $request->validate(
            // Rules
            [
                'text_username' => 'required | email',
                'text_password' => 'required | min:6 | max:16',
            ],
            // Error messages
            [
                'text_username.required' => 'O campo usuário é obrigatório.',
                'text_username.email' => 'O email inserido é inválido.',
                'text_password.required' => 'O campo senha é obrigatório.',
                'text_password.min' => 'O campo senha deve ter no mínimo :min caracteres.',
                'text_password.max' => 'O campo senha deve ter no máximo :max caracteres.',
            ]
        );

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        echo $username;
        echo $password;
    }

    public function logout()
    {
        echo 'logout';
    }
}
