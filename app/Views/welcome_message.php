<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <style>
    .grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
    }
    .card {
      border: 1px solid #ccc;
      padding: 20px;
      border-radius: 5px;
      text-align: center;
    }
    .card button {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <?= view('layout/navbar') ?>

  <h1>Tela incial</h1>

  <div class="grid-container">
    <?php foreach ($games as $game): ?>
      <div class="card">
        <h2><?= esc($game['title']) ?></h2>
        <p><?= esc($game['description']) ?></p>
        <p>Preço: <?= esc($game['price']) ?></p>
      </div>
    <?php endforeach ?>
  </div>
</body>
</html>
