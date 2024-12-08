<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request) {

        $messages = [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'genre.required' => 'O genero é obrigatório.',
            'role.required' => 'O cargo é obrigatório.',
            'password.required' => 'A senha é obrigatória.',

            'email.unique' => 'Este e-mail já está cadastrado.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|email|unique:users,email',
            'genre' => 'required|string|max:1',
            'role' => 'required|string',
            'password' => 'required|string|confirmed'
        ], $messages);

        $validatedData['password'] = bcrypt($validatedData['password']);

        return User::create($validatedData);
    }
}
