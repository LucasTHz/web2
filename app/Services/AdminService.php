<?php
namespace App\Services;

use App\Enums\UserRolesEnum;
use App\Models\UserModel;
use CodeIgniter\Config\BaseService;

class AdminService extends BaseService
{
  public function list(): array
  {
    $users = (new UserModel())->findAll();

    return $users;
  }

  public function updateUserRole(int $id, int $role): void
  {
    if (!in_array($role, [UserRolesEnum::CLIENT->value, UserRolesEnum::PRODUCER->value])) {
      throw new \Exception('Invalid role');
    }

    (new UserModel())->update($id, ['role_id' => $role]);
  }
}