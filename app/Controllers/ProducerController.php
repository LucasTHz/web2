<?php

namespace App\Controllers;

use App\Enums\UserRolesEnum;
use App\Models\UserModel;
use App\Validation\StoreUserValidation;

class ProducerController extends BaseController
{
    public function create()
    {
        return \view('user/producer/create');
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
            'role_id'  => UserRolesEnum::PRODUCER->value,
            'birthday_at' => $data['date'],
            "password" => \password_hash($data['password'], PASSWORD_DEFAULT),
        ]);

        return \redirect()->back()->with('success', ['Produtor cadastrado com sucesso']);
    }
}
