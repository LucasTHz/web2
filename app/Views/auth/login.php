<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <?= view('layout/navbar') ?>
  <div>
    <h1>Login</h1>
    <form action="/auth/login" method="post">
      <?= csrf_field() ?>
      <?php if (session()->has('errors')): ?>
        <div>
          <ul>
            <?php foreach (session('errors') as $error): ?>
              <li style="color: red;"><?= esc($error) ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif ?>
      <label for="email">E-mail</label>
      <input type="email" id="email" name="email" required><br><br>

      <label for="password">Senha</label>
      <input type="password" id="password" name="password" required><br><br>

      <input type="submit" value="Entrar">
    </form>
  </div>
</body>
</html>