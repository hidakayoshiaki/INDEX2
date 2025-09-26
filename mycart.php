<?php

session_start();
$_SESSION['navigated_within_site'] = true;

// ログインしていなければ、ログインページにリダイレクト
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include "./db.php";
$db = new DbConnection();
$pdo = $db->connect();

try {
    $user_id = $_SESSION['user_id'];

    $sql = "
        SELECT p.name AS product_name, p.price, COUNT(c.product_id) AS quantity
        FROM carts c
        JOIN products_room p ON c.product_id = p.id
        WHERE c.user_id = ?
        GROUP BY c.product_id, p.name, p.price
        ORDER BY p.name
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $carts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // 実際の本番環境では、エラーメッセージを直接表示するのではなく、ログに記録します。
    die("データベースエラーが発生しました: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ご予約中のお部屋</title>
    <link rel="stylesheet" href="./css/mycart.css">
</head>

<body>
    <h1>ご予約中のお部屋</h1>
    <div class="mycart-center">
        <?php if (empty($carts)): ?>
            <p>現在、ご予約中のお部屋はありません。</p>
        <?php else: ?>
            <ul>
                <?php foreach ($carts as $cart): ?>
                    <li>
                        <?= htmlspecialchars($cart['product_name'], ENT_QUOTES) ?> (数量: <?= htmlspecialchars($cart['quantity']) ?>)
                    </li>
                <?php endforeach; ?>
            </ul>
            <form action="./order-management.php" method="POST">
                <button type="submit" name="order_confirm">この内容で予約を確定する</button>
            </form>
        <?php endif; ?>
        <p><a href='./product-page.php'>トップページに戻る</a></p>
    </div>
</body>

</html>