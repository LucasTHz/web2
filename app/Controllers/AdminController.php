<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Enums\UserRolesEnum;

class AdminController extends BaseController
{
    public function listUsers()
    {
        $users = (new UserModel())->findAll();
        return view('admin/user_list', ['users' => $users]);
    }

    public function updateUserRole($id)
    {
        $data = $this->request->getPost();
        $role = $data['role'];

        if (!in_array($role, [UserRolesEnum::CLIENT->value, UserRolesEnum::PRODUCER->value])) {
            return redirect()->back()->with('errors', ['Invalid role']);
        }

        (new UserModel())->update($id, ['role_id' => $role]);

        return redirect()->back()->with('success', 'User role updated successfully');
    }
}
