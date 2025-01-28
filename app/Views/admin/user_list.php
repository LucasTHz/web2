<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciar usuarios</title>
</head>
<body>
  <?= view('layout/navbar') ?>
  <h1>Gerenciar usuarios</h1>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Perfil</th>
        <th scope="col">Acoes</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= esc($user['name']) ?></td>
          <td><?= esc($user['email']) ?></td>
          <td><?= esc($user['role_id']) ?></td>
          <td>
            <form action="/admin/updateUserRole/<?= $user['id'] ?>" method="post">
              <div style="display: flex; gap: 8px">
              <select name="role" class="form-select">
                <option value="<?= \App\Enums\UserRolesEnum::CLIENT->value ?>" <?= $user['role_id'] == \App\Enums\UserRolesEnum::CLIENT->value ? 'selected' : '' ?>>Cliente</option>
                <option value="<?= \App\Enums\UserRolesEnum::PRODUCER->value ?>" <?= $user['role_id'] == \App\Enums\UserRolesEnum::PRODUCER->value ? 'selected' : '' ?>>Produtor</option>
              </select>
              <button type="submit" class="btn btn-primary">Atualizar</button>
              </div>

            </form>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</body>
</html>
