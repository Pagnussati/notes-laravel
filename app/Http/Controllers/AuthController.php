<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Geting form data
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // Check existing user
        $user = User::where('username', $username)-> where('deleted_at', NULL)-> first();

        if (!$user) {
            return redirect()->back()->withInput()->with('loginError', 'Usuario ou senha incorreto.');
        }

        // Checking password
        if (!password_verify($password, $user->password)) {
            return redirect()->back()->withInput()->with('loginError', 'Usuario ou senha incorreto.');
        }

        // Updating last login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        // Login user
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username
            ]
        ]);

        echo '<h1>LOGIN EFETUADO COM SUCESSO</h1>';
        echo '<pre>';
        print_r($user);
    }

    public function logout()
    {
        // Logout
        session()->forget('user');
        return redirect()->to('/login');
    }
}
