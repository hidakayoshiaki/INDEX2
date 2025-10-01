<?php
session_start();

// ログインしていなければ、ログインページにリダイレクト
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include __DIR__ . '/../server-db/db.php';

$db = new DbConnection();
$pdo = $db->connect();


$user_id = $_SESSION['user_id'];
    $sql = "
        SELECT p.name AS product_name, c.product_id
        FROM carts c
        JOIN products_room p ON c.product_id = p.id
        WHERE c.user_id = ?
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $carts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($carts as $cart) {
        echo "登録した商品: " . htmlspecialchars($cart['product_name'], ENT_QUOTES) . "<br>";
    }





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約内容の確認</title>
</head>

<body>

    <p><a href='./product-page.php'>戻る</a>
    <p>

</body>

</html>


<?php
