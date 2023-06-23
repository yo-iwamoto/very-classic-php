<?php

$id = $_GET['id'];

$db = new PDO('sqlite:../dev.db');

$stmt = $db->prepare('SELECT * FROM products WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$product = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index.php?</title>
</head>
<body>
  <h1><?= $product['name'] ?></h1>

  <a href="/form">一覧に戻る</a>
</body>
</html>
