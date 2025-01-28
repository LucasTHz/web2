<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" lang="pt-br">
  <title>Meu Perfil</title>
</head>
<body>
  <?= view('layout/navbar') ?>

  <?php if (session()->has('success')): ?>
    <div>
      <p style="color: green;"><?= session('success') ?></p>
    </div>
  <?php endif ?>

  <form action="/user/client/update/<?= session('id_user') ?>" method="post">
    <?= csrf_field() ?>
    <h1>Meu perfil</h1>
    <?php if (session()->has('errors')): ?>
      <div>
        <ul>
          <?php foreach (session('errors') as $error): ?>
            <li style="color: red;"><?= esc($error) ?></li>
          <?php endforeach ?>
        </ul>
      </div>
    <?php endif ?>

    <div>
      <label for="name">Nome:</label>
      <input type="text" id="name" name="name" required value="<?= $user['name'] ?>" ><br><br>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required value="<?= $user['email'] ?>"><br><br>

      <label for="date">Data de Nascimento:</label>
      <input type="date" id="date" name="date" required  lang="pt-BR" value="<?= $user['birthday_at'] ?>"><br><br>

      <input type="submit" value="Atualizar">
    </div>
  </form>

  <form action="/user/client/update_balance/<?= session('id_user') ?>" method="post">
    <?= csrf_field() ?>
    <div style="display: flex; justify-content: space-between;">
      <h2>Saldo: R$ <?= $user['balance'] ?></h2>
    </div>
    <div>
      <label for="balance">Saldo:</label>
      <input type="number" id="balance" name="balance" min="0" step="0.01" required value="<?= $user['balance'] ?>"><br><br>
      <input type="submit" value="Atualizar Saldo">
    </div>
  </form>

  <h2>Histórico</h2>
  <a href="/cart/purchase_history">Ver Histórico de Compras</a><br>
  <a href="/cart/deposit_history">Ver Histórico de Depósitos</a>
</body>
</html>