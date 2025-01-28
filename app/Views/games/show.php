<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($game['title']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?= view('layout/navbar') ?>
  <div class="container mt-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?= esc($game['title']) ?></h5>
  <img src="<?= esc($game['path_img']) ?>" alt="<?= esc($game['title']) ?>" class="img-thumbnail" style="max-width: 300px;">

        <p class="card-text"><?= esc($game['description']) ?></p>
        <p class="card-text"><strong>Preço:</strong> R$ <?= esc($game['price']) ?></p>
        <h6 class="card-subtitle mb-2 text-muted">Reviews</h6>
        <ul class="list-group list-group-flush">
          <?php foreach ($reviews as $review): ?>
            <li class="list-group-item"><?= esc($review['review']) ?> - <strong><?= esc($review['user_name']) ?></strong> - Nota <?= esc($review['rating']) ?> / 5</li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>