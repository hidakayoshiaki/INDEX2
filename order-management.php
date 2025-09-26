<?php
session_start();
$_SESSION['navigated_within_site'] = true;
include "./db.php";

$db = new DbConnection();
$pdo = $db->connect();

// ログインしていない場合は、ログインページにリダイレクト
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header('Location: login.php');
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/order-management.css">
    <title>Document</title>
</head>

<body>
    <?php
    // POSTリクエストで「予約を確定する」ボタンが押された場合のみ処理を実行
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_confirm'])) {
        try {
            // 1. カートの中身を取得（数量を計算）
            $sql_cart = "
            SELECT
                p.name AS product_name,
                c.product_id,
                COUNT(c.product_id) AS quantity
            FROM carts c
            JOIN products_room p ON c.product_id = p.id
            WHERE c.user_id = ?
            GROUP BY c.product_id, p.name
        ";
            $stmt_cart = $pdo->prepare($sql_cart);
            $stmt_cart->execute([$user_id]);
            $carts = $stmt_cart->fetchAll(PDO::FETCH_ASSOC);

            // カートが空の場合は処理を中断し、カートページに戻る
            if (empty($carts)) {
                header('Location: mycart.php');
                exit;
            }

            // 2. トランザクションを開始して、データの整合性を保証する
            $pdo->beginTransaction();

            // 3. `orders`テーブルに注文記録を作成
            $stmt_order = $pdo->prepare("INSERT INTO orders (user_id, created_at) VALUES (?, NOW())");
            $stmt_order->execute([$user_id]);
            $order_id = $pdo->lastInsertId();

            // 4. `order_items`テーブルに注文明細を保存
            $stmt_items = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
            foreach ($carts as $cart) {
                $stmt_items->execute([$order_id, $cart['product_id'], $cart['quantity']]);
            }

            // 5. カートを空にする
            $stmt_delete = $pdo->prepare("DELETE FROM carts WHERE user_id = ?");
            $stmt_delete->execute([$user_id]);

            // 6. すべての処理が成功したら、トランザクションをコミット
            $pdo->commit();

            // 7. ユーザーに完了メッセージと注文内容を表示
            echo "<div class='order-management-box'>";
            echo "<h1>ご注文頂き誠にありがとうございます。</h1>";
            echo "<p>以下の内容でご予約を承りました。</p>";
            echo "<ul>";
            foreach ($carts as $cart) {
                echo "<li>" . htmlspecialchars($cart['product_name'], ENT_QUOTES) . " (数量: " . htmlspecialchars($cart['quantity']) . ")</li>";
            }
            echo "</ul>";
            echo "<p><a href='./product-page.php'>お部屋一覧に戻る</a></p>";
            echo "<p><a href='./order-history.php'>ご予約履歴を確認する</a></p>";
            echo "</div>";
        } catch (PDOException $e) {
            // エラーが発生した場合は、変更をすべて元に戻す（ロールバック）
            $pdo->rollBack();
            // 実際の本番環境では、エラーメッセージを直接表示せず、ログに記録します。
            die("注文処理中にエラーが発生しました: " . $e->getMessage());
        }
    } else {
        // POST以外の方法でアクセスされた場合は、カートページにリダイレクト
        header('Location: mycart.php');
        exit;
    }

    ?>

</body>

</html>