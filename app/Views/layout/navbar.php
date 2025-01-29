<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <title>Navbar</title>
  <style>
    .navbar {
      display: flex;
      justify-content: space-between;
      background-color: #333;
      padding: 10px;
    }
    .navbar a {
      color: white;
      padding: 14px 20px;
      text-decoration: none;
      text-align: center;
    }
    .navbar a:hover {
      background-color: #ddd;
      color: black;
    }
  </style>
</head>
<body>

<nav class="navbar bg-dark border-bottom border-body">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Steam verde</a>
    <div style="display: flex;">
      // Nome do usuário logado
      <p style="color: white; margin-right: 10px;"><?= session('name') ?></p>

        <?php if (session('role_id') == '2'): ?>
          <a class="nav-link" href="/user/client/edit/<?= session('id_user') ?>">Perfil</a>
          <a class="nav-link" href="/cart">Carrinho</a>
        <?php endif ?>
        <?php if (session('role_id') == '1'): ?>
          <a class="nav-link" href="/admin/producer/create">Cadastro Produtor</a>
          <a class="nav-link" href="/admin/users">Gerenciar Usuários</a>
        <?php endif ?>
        <?php if (session('id_user')) : ?>
        <a class="nav-link active" aria-current="page" href="/dashboard">Home</a>
            <a class="nav-link" href="/logout">Sair</a>
        <?php else: ?>
        <a class="nav-link active" aria-current="page" href="/">Home</a>
        <a class="nav-link" href="/login">Login</a>
        <a class="nav-link" href="/user/client/create">Cadastro Cliente</a>
        <?php endif ?>

        <?php if (session('role_id') == '3'): ?>
        <a class="nav-link" href="/user/producer/edit/<?= session('id_user')?> ">Perfil</a>
            <a class="nav-link" href="/user/producer/game/create">Cadastro de jogo</a>
            <a class="nav-link" href="/user/producer/game/create">Jogos</a>
        <?php endif ?>
    </div>
    </div>
</nav>
</body>
</html>
