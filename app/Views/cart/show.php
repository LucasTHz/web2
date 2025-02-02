<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meu carrinho</title>
</head>
<body>
  <?= view('layout/navbar') ?>
  <?php if (session()->has('errors')): ?>
    <div>
      <?php foreach (session('errors') as $message): ?>
        <div class="alert alert-warning" role="alert">
        <?= esc($message) ?>
</div>
      <?php endforeach ?>
    </div>
  <?php endif ?>
  <h1>Meu carrinho</h1>

  <?php if (session()->has('success')): ?>
    <div>
      <?php foreach (session('success') as $message): ?>
        <p><?= esc($message) ?></p>
      <?php endforeach ?>
    </div>
  <?php endif ?>


  <table class="table">
    <thead>
      <tr>
        <th>Produto</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Subtotal</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cart as $item): ?>
        <tr>
          <td><?= esc($item['title']) ?></td>
          <td>R$ <?= esc($item['price']) ?></td>
          <td><?= esc($item['quantity']) ?></td>
          <td>R$ <?= esc($item['total']) ?></td>
          <td>
            <form action="/cart/remove/<?= $item['id'] ?>" method="get">
              <button type="submit">Remover</button>
            </form>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <h2>Total: R$ <?= esc($total) ?></h2>
  <form action="/cart/buy" method="post">
    <button type="submit">Finalizar compra</button>
  </form>
</body>
</html>