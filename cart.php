<?php

session_start();
include "./db.php";
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


    echo 
    "<head>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='./css/cart.css' />
    </head>";
    echo "<body>";
    echo"<div class='cart-center'>";
    echo "<p>ご予約に追加しました</p>";
    echo "<p><a href='./mycart.php'>ご予約を確認する</a></p>";
     echo "</body>";
         echo"</div>";
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}
