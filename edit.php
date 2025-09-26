<?php
session_start();
include "./db.php";

$db = new DbConnection();
$pdo = $db->connect();


$id = $_GET['id'] ?? null;

// IDが指定されていない、または数字でない場合はエラー処理
if (!$id || !is_numeric($id)) {
    echo "IDが正しく指定されていません。";
    echo "<p><a href='./1234.php'>一覧に戻る</a></p>";
    exit;
}

// 2. データベースから既存の投稿データを取得
try {
    $stmt = $pdo->prepare("SELECT * FROM test WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // 投稿が見つからない場合のエラー処理
    if (!$post) {
        echo "指定された投稿が見つかりません。";
        echo "<p><a href='./1234.php'>一覧に戻る</a></p>";
        exit;
    }
} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
    exit;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記事の編集</title>
</head>
<body>
    <h1>記事の編集</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8') ?>">
        <p>タイトル: <input type="text" name="name" value="<?= htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8') ?>" required></p>
        <p>内容:</p>
        <textarea name="article" cols="50" rows="10" required><?= htmlspecialchars($post['article'], ENT_QUOTES, 'UTF-8') ?></textarea>
        <p><input type="submit" value="更新する"></p>
    </form>
    <p><a href="./1234.php">一覧に戻る</a></p>
</body>
</html>