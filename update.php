<?php
session_start();
include "./db.php";

// POSTリクエストでない場合は処理を中断
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "不正なアクセスです。";
    exit;
}

$db = new DbConnection();
$pdo = $db->connect();

// 1. フォームから送信されたデータを取得
$id = $_POST['id'] ?? null;
$name = $_POST['name'] ?? '';
$article = $_POST['article'] ?? '';

// 2. バリデーション (IDがない、タイトルが空など)
if (!$id || !is_numeric($id)) {
    echo "IDが不正です。";
    exit;
}
if (trim($name) === '') {
    echo "タイトルは必須です。";
    exit;
}

// 3. データベースを更新
try {
    $stmt = $pdo->prepare("UPDATE test SET name = ?, article = ? WHERE id = ?");
    $stmt->execute([$name, $article, $id]);

    echo "<h1>記事を更新しました。</h1>";
    echo "<p><a href='1234.php'>一覧に戻る</a></p>";

} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
    exit;
}
?>