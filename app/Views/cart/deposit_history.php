<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Histórico de Depósitos</title>
</head>
<body>
  <?= view('layout/navbar') ?>
  <h1>Histórico de Depósitos</h1>
  <table class="table">
    <thead>
      <tr>
        <th>Valor</th>
        <th>Data</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($deposits as $deposit): ?>
        <tr>
          <td>R$ <?= esc($deposit['amount']) ?></td>
          <td><?= esc($deposit['created_at']) ?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</body>
</html>
