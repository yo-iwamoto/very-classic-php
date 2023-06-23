<?php

$db = new PDO('sqlite:./dev.db');

$stmt = $db->prepare('SELECT * FROM posts');
$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];

  $stmt = $db->prepare('INSERT INTO posts (title) VALUES (:title) RETURNING id');
  $stmt->bindParam(':title', $title, PDO::PARAM_STR);
  $stmt->execute();

  $result = $stmt->fetch();

  http_response_code(302);
  header("Location: /post?id={$result['id']}");
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index.php?</title>
</head>
<body>
  <h1>投稿の作成</h1>

  <form action="/" method="POST">
    <input type="text" name="title" required>
    <input type="submit" value="作成">
  </form>

  <h2>投稿一覧</h2>
  <ul>
    <?php foreach ($posts as $post): ?>
      <li>
        <article>
          <a href="<?= "/post?id={$post['id']}" ?>">
            <?= $post['title']; ?>
          </a>
        </article>
      </li>
    <?php endforeach; ?>  
  </ul>
</body>
</html>
