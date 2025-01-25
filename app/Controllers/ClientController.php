<?php

namespace App\Controllers;

use App\Enums\UserRolesEnum;
use App\Models\UserModel;
use App\Validation\StoreUserValidation;

class ClientController extends BaseController
{
    public function create()
    {
        return \view('user/client/create');
    }

    public function store()
    {
        $data = $this->request->getPost();

        $validated = $this->validate(
            StoreUserValidation::rules(),
            StoreUserValidation::messages()
        );

        if (!$validated) {
            return \redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        (new UserModel())->insert([
            ...$data,
            'role_id'  => UserRolesEnum::CLIENT->value,
            "password" => \password_hash($data['password'], PASSWORD_DEFAULT),
        ]);

        return \redirect()->to('/login');
    }
}
