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
      </tr>
    </thead>
    <tbody>
      <?php foreach ($purchases as $purchase): ?>
        <tr>
          <td><?= esc($purchase['title']) ?></td>
          <td><?= esc($purchase['quantity']) ?></td>
          <td>R$ <?= esc($purchase['total']) ?></td>
          <td><?= esc($purchase['created_at']) ?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</body>
</html>
