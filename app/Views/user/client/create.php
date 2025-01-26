<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" lang="pt-br">
  <title>Cadastro de cliente</title>
</head>
<body>
  <?= view('layout/navbar') ?>
  <form action="/user/client/store" method="post">
    <?= csrf_field() ?>
    <h1>Cadastro de cliente</h1>

    <?php if (session()->has('errors')): ?>
      <div>
        <ul>
          <?php foreach (session('errors') as $error): ?>
            <li style="color: red;"><?= esc($error) ?></li>
          <?php endforeach ?>
        </ul>
      </div>
    <?php endif ?>

    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Senha:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="confirme-password">Senha:</label>
    <input type="password" id="confirme-password" name="confirme-password" required><br><br>

    <label for="date">Data de Nascimento:</label>
    <input type="date" id="date" name="date" required  lang="pt-BR"><br><br>

    <input type="submit" value="Cadastrar">
  </form>
</body>
</html>