<?php

namespace App\Controllers;

use App\Services\AdminService;
use Throwable;

class AdminController extends BaseController
{
    public function __construct(private AdminService $service)
    {
    }

    public function listUsers()
    {
        $users = $this->service->list();
        return view('admin/user_list', ['users' => $users]);
    }

    public function updateUserRole($id)
    {
        try {
            $data = $this->request->getPost();
            $role = $data['role'];

            $this->service->updateUserRole($id, $role);

            return redirect()->back()->with('success', 'Perfil de acesso atualizado com sucesso');
        } catch (Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
