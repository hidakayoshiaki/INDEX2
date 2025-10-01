<?php

session_start();
$_SESSION['navigated_within_site'] = true;
include __DIR__ . '/../server-db/db.php';

$db = new DbConnection();
$pdo = $db->connect();

// ログインしていない場合は、ログインページにリダイレクト
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// ログインしているユーザーのIDを取得
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/order-history.css">
    <title>Document</title>
</head>

<body>
    <h1>ご予約履歴</h1>
    <div class="order-center">
        <div class='order-over-flow'>
            <?php if (empty($orders)): ?>
                <p>ご予約の履歴はありません。</p>
            <?php else: ?>
                <?php foreach ($orders as $order): ?>
                    <div class="order-box">
                        <p>注文ID: <?= htmlspecialchars($order['id']) ?></p>
                        <p>注文日時: <?= htmlspecialchars($order['created_at']) ?></p>
                        <p>注文内容:</p>
                        <ul>
                            <?php
                            // 注文ごとの商品明細を取得
                            $sql_items = "
                            SELECT oi.quantity, p.name AS product_name
                            FROM order_items oi
                            JOIN products_room p ON oi.product_id = p.id
                            WHERE oi.order_id = ?
                        ";
                            $stmt2 = $pdo->prepare($sql_items);
                            $stmt2->execute([$order['id']]);
                            $items = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($items as $item):
                            ?>
                                <li>客室名: <?= htmlspecialchars($item['product_name']) ?> / 数量: <?= htmlspecialchars($item['quantity']) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="order-box2">
            <p><a href="product-page.php">topページへ戻る</a></p>
            <p>※ご予約の変更はお電話で承っております</p>
        </div>
    </div>


</body>

</html>