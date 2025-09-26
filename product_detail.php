<?php
session_start();

$_SESSION['navigated_within_site'] = true;


$product_id = $_GET['id'] ?? null;

// IDがなければトップページに戻す
if (!$product_id || !is_numeric($product_id)) {
    header('Location: product-page.php');
    exit;
}

include "./db.php";
$db = new DbConnection();
$pdo = $db->connect();


$stmt = $pdo->prepare("SELECT * FROM products_room WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// 商品が見つからなければエラー表示
if (!$product) {
    http_response_code(404);
    echo "お探しの商品は見つかりませんでした。";
    echo "<p><a href='product-page.php'>トップページへ戻る</a></p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> - ホテル鹿児島</title>
    <link rel="stylesheet" href="./css/product-detail.css">
    <link rel="stylesheet" href="./css/header.css"> 
</head>
<body>
      <?php
    include "./product-header.php";
    ?>

    <main class="product-detail-container">
        <h1><?= htmlspecialchars($product['name']) ?></h1>
        <div class="product-detail-box">
            <div class="product-image">
                <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?> " width='150' height='auto'>
            </div>
            <div class="product-info">
                <p class="description"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                <p class="price">¥<?= number_format($product['price']) ?> 円</p>

                
                <form action="cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                    <button type="submit" class="add-to-cart-btn">ご予約中のお部屋に追加する</button>
                </form>
            </div>
             <p class='product-detail-box2'><a href="product-page.php">客室一覧に戻る</a></p>
        </div>
       
    </main>

</body>
</html>
