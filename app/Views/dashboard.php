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

  <?php if (session()->has('success')): ?>
    <div>
    <?php foreach (session('success') as $succes): ?>
      <div class="alert alert-success" role="alert">
        <?= esc($succes) ?>
</div>
          <?php endforeach ?>
    </div>

  <?php endif ?>

  <?php if (!empty($games)): ?>
    <?php foreach ($games as $game): ?>
      <div class="card">
        <h2><a href="/game/<?= $game['id']?>"> <?= esc($game['title']) ?></a></h2>
        <p><?= esc($game['description']) ?></p>
        <p>Preço: <?= esc($game['price']) ?></p>
        <?php if (!empty($game['path_img'])): ?>
          <?php echo $game['title'] ?>
          <img src="<?=esc($game['path_img']) ?>" alt="<?= esc($game['title']) ?>" style="width: 100%; height: auto;">
        <?php endif; ?>
        <?php if (session('role_id') == '3'): ?>
          <button  type="button" class="btn btn-primary" onclick="location.href='/user/producer/game/edit/<?= $game['id'] ?>'">Editar</button>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" >Deletar</button>
        <?php else: ?>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#buyModal<?= $game['id'] ?>">Adicionar ao carrinho</button>

        <form action="/cart/add/<?= $game['id'] ?>" method="post">
          <div class="modal fade" id="buyModal<?= $game['id'] ?>" tabindex="-1" aria-labelledby="buyModalLabel<?= $game['id'] ?>" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="buyModalLabel<?= $game['id'] ?>">Comprar <?= esc($game['title']) ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="/buy/<?= $game['id'] ?>" method="post">
                    <div class="mb-3">
                      <label for="quantity<?= $game['id'] ?>" class="form-label">Quantidade</label>
                      <input type="number" class="form-control" id="quantity<?= $game['id'] ?>" name="quantity" min="1" value="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar ao carrinho</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php endif ?>
      </div>
    <?php endforeach ?>
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
  <?php else : ?>
    <div style="display: flex; justify-items: center; align-items: center;">
      <h2>Nenhum jogo cadastrado</h2>
    </div>
  <?php endif ?>
  </div>

</div>


  <?php if (session('role_id') == '3'): ?>
    <button onclick="location.href='/user/producer/game/create'">Adicionar Jogo</button>
  <?php endif ?>
</body>
</html>
