<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Histórico de Compras</title>
</head>
<body>
  <?= view('layout/navbar') ?>
  <h1>Histórico de Compras</h1>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Jogo</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Total</th>
        <th scope="col">Data</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($purchases as $purchase): ?>
        <tr>
          <td><?= esc($purchase['title']) ?></td>
          <td><?= esc($purchase['quantity']) ?></td>
          <td>R$ <?= esc($purchase['total']) ?></td>
          <td><?= esc($purchase['created_at']) ?></td>
          <td>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal<?= $purchase['game_id'] ?>">Avaliar</button>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>

  <?php foreach ($purchases as $purchase): ?>
    <form action="/game/review/<?= $purchase['game_id'] ?>" method="post">
      <div class="modal fade" id="reviewModal<?= $purchase['game_id'] ?>" tabindex="-1" aria-labelledby="reviewModalLabel<?= $purchase['game_id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="reviewModalLabel<?= $purchase['game_id'] ?>">Avaliar <?= esc($purchase['title']) ?></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="review" class="form-label">Avaliação</label>
                <textarea class="form-control" id="review" name="review" required></textarea>
              </div>
              <div class="mb-3">
                <label for="rating" class="form-label">Nota</label>
                <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
              </div>
              <button type="submit" class="btn btn-primary">Enviar Avaliação</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  <?php endforeach ?>

</body>
</html>
