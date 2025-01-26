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
        <?php if (session('role_id') == '3'): ?>
          <button  type="button" class="btn btn-primary" onclick="location.href='/user/producer/game/edit/<?= $game['id'] ?>'">Editar</button>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" >Deletar</button>
        <?php else: ?>
          <button>Comprar</button>
        <?php endif ?>
      </div>
    <?php endforeach ?>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Deletar jogo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Deseja realmente deletar o jogo?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nao</button>
        <button type="button" class="btn btn-danger" onclick="location.href='/user/producer/game/delete/<?= $game['id'] ?>'">Sim</button>
      </div>
    </div>
  </div>
</div>


  <?php if (session('role_id') == '3'): ?>
    <button onclick="location.href='/user/producer/game/create'">Adicionar Jogo</button>
  <?php endif ?>
</body>
</html>
