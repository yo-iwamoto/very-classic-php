<?php

$db = new PDO('sqlite:../dev.db');

$stmt = $db->prepare('SELECT * FROM products');
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $db->prepare('INSERT INTO products (name) VALUES (:name) RETURNING *');
  $stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
  $stmt->execute();
  $rows = $stmt->fetchAll();

  http_response_code(302);
  header("Location: /product?id={$rows[0]['id']}");
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
</head>
<body>
  <form method="POST">
    <input type="text" name="name">
    <button type="submit">Submit</button>
  </form>

  <h2>products</h2>
  <ul>
    <?php foreach ($products as $product): ?>
      <li>
        <article>
          <a href="<?= "/product?id={$product['id']}" ?>">
            <?= $product['name']; ?>
          </a>
        </article>
      </li>
    <?php endforeach; ?>  
  </ul>
</body>
</html>
