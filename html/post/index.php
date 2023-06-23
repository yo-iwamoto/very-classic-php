<?php

$id = $_GET['id'];

$db = new PDO('sqlite:../dev.db');

$stmt = $db->prepare('SELECT * FROM posts WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$post = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index.php?</title>
</head>
<body>
  <h1><?= $post['title'] ?></h1>

  <a href="/">一覧に戻る</a>
</body>
</html>
