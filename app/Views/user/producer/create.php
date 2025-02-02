<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" lang="pt-br">
  <title>Cadastro de cliente</title>
</head>
<body>
<form action="/admin/producer/store" method="post">
  <?= view('layout/navbar') ?>

  <?= csrf_field() ?>
  <h1>Cadastro de produtores</h1>

  <?php if (session()->has('errors')): ?>
    <div>
      <ul>
        <?php foreach (session('errors') as $error): ?>
          <li style="color: red;"><?= esc($error) ?></li>
        <?php endforeach ?>
      </ul>
    </div>
  <?php endif ?>

  <?php if (session()->has('success')): ?>
    <div>
      <?php foreach (session('success') as $message): ?>
        <div class="alert alert-success" role="alert">
        <?= esc($message) ?>
        </div>
      <?php endforeach ?>
    </div>
  <?php endif ?>

  <label for="name">Nome:</label>
  <input type="text" id="name" name="name" required><br><br>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required><br><br>

  <label for="password">Senha:</label>
  <input type="password" id="password" name="password" required><br><br>

  <label for="confirme-password">Confirme a senha:</label>
  <input type="password" id="confirme-password" name="confirme-password" required><br><br>

  <label for="date">Data de Nascimento:</label>
  <input type="date" id="date" name="date" required  lang="pt-BR"><br><br>

  <input type="submit" value="Cadastrar">
</form>
</body>
</html>