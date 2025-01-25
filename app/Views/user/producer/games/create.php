<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar um jogo</title>
</head>
<body>

<form action="./store" method="post">

  <?= csrf_field() ?>

  <h1>Cadastrar um jogo</h1>

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
      <p style="color: green;"><?= session('success') ?></p>
    </div>
  <?php endif ?>

  <label for="title">Título:</label>
  <input type="text" id="title" name="title" required><br><br>

  <label for="description">Descrição:</label>
  <textarea id="description" name="description" required></textarea><br><br>

  <label for="price">Preço:</label>
  <input type="number" id="price" name="price" min="0" step="0.01" required><br><br>

  <input type="submit" value="Cadastrar">

</form>
</body>
</html>