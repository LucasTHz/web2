<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function auth()
    {
        $data = $this->request->getPost();

        $validated = $this->validate([
            'email'    => 'required|valid_email',
            'password' => 'required',
        ]);

        if (!$validated) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = (new UserModel())->where('email', $data['email'])->first();

        if (!$user || !password_verify($data['password'], $user['password'])) {
            return redirect()->back()->withInput()->with('errors', ['Senha ou email inválidos']);
        }

        session()->set(['id_user' => $user['id'], 'role_id' => $user['role_id']]);

        $games = (new GameModel())->findAll();

        return view('dashboard', ['games' => $games]);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }

    public function unauthorized()
    {
        return view('unauthorized');
    }
}
