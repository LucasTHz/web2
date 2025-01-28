<?php

namespace App\Controllers;

use App\Enums\UserRolesEnum;
use App\Models\DepositModel;
use App\Models\UserModel;
use App\Validation\StoreUserValidation;
use App\Validation\UpdateUserValidation;
use DateTime;

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
            'role_id'     => UserRolesEnum::CLIENT->value,
            'birthday_at' => DateTime::createFromFormat('Y-m-d', $data['date'])->format('Y-m-d'),
            "password"    => \password_hash($data['password'], PASSWORD_DEFAULT),
        ]);

        return \redirect()->to('/login');
    }

    public function edit($id)
    {
        $user = (new UserModel())->find($id);

        unset($user['password']);

        $user['birthday_at'] = date('Y-m-d', strtotime($user['birthday_at']));

        return \view('user/client/edit', ['user' => $user]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        $validated = $this->validate(
            UpdateUserValidation::rules($id),
            UpdateUserValidation::messages()
        );

        if (!$validated) {
            return \redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        (new UserModel())->update($id, [
            ...$data,
            'birthday_at' => DateTime::createFromFormat('Y-m-d', $data['date'])->format('Y-m-d'),
        ]);

        return \redirect()->back()->with('success', 'Usuário atualizado com sucesso');
    }

    public function updateBalance(string $id)
    {
        $data = $this->request->getPost();

        (new DepositModel())->insert([
            'user_id' => $id,
            'amount'  => $data['balance'],
        ]);

        $balanceCurrent = (new UserModel())->find($id)['balance'] ?? 0;

        (new UserModel())->update($id, [
            'balance' => $data['balance'] + $balanceCurrent,
        ]);

        return \redirect()->back()->with('success', 'Saldo atualizado com sucesso');
    }
}
