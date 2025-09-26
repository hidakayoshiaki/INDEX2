<?php
session_start();
include "./db.php";
$db = new DbConnection();
$pdo = $db->connect();

$stmt = $pdo->prepare(
    " SELECT o.id AS order_id, o.user_id, o.created_at, o.status, u.username
    FROM orders o
    LEFT JOIN userdatatest u ON o.user_id = u.id
    ORDER BY o.created_at DESC"
);

$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注文管理画面</title>
</head>
<body>
    <?php foreach($orders as $order); ?>
    <div>
        <p><?= $order['order_id'];?></p>
        <p><?= $order['user_id'];?></p>
        <p><?= $order['created_at'];?></p>
         <p><?= $order['username'];?></p>
    </div>
   
</body>
</html>