<?php

session_start();
include __DIR__ . '/../server-db/db.php';
$db = new DbConnection();
$pdo = $db->connect();

try {

    // ログインしていない場合はログインページにリダイレクト
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $_POST["product_id"] ?? null;

    $stmt = $pdo->prepare("INSERT INTO carts(user_id,product_id ) VALUES(?,?)");
    $stmt->execute([$user_id, $product_id]);

    // 処理が完了したらマイカートページへリダイレクト
    header('Location: ./mycart.php');
    exit;

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}
