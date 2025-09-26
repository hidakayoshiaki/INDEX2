<?php
session_start();

$animation_class = 'animation-opacity';
$animation_class2 = 'product-first-animation';

// ページ内リンクの場合フラグをアンセットしアニメーションを無効
if (isset($_SESSION['navigated_within_site'])) {
    $animation_class = '';
    $animation_class2 = 'animation-first-none';
    unset($_SESSION['navigated_within_site']); 
}

include "./db.php";
$db = new DbConnection();
$pdo = $db->connect();

// データベースから商品（客室）情報をすべて取得
$stmt = $pdo->query("SELECT * FROM products_room");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$product_chunks = array_chunk($products, 3);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <link rel="stylesheet" href="./css/product-page.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/side-menu.css?<?php   ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes">
    <script src="./js/product-page.js" defer></script>
    <meta charset="UTF-8">
    <title>HOTELKAGOSIMA</title>
</head>

<body>
    <div class="<?php echo $animation_class2; ?>">
        <p>出張という日常に、上質な安らぎを。</p>
    </div>
    <!-- ヘッダーとメインコンテンツ全体を囲むdivにアニメーションクラスを適用 -->
    <div class="<?php echo $animation_class; ?>">
        <?php include "./product-header.php"; ?>

        <div class="page-flex ">

            <article>
                <section>
                    <div class="product-width">
                        <div class="product-center">

                            <div onclick="modalOpen()">
                                <?php include_once("./modal.php") ?>
                            </div>
                            <?php foreach ($product_chunks as $chunk) : ?>
                                <div class="product-flex">
                                    <?php foreach ($chunk as $product) : ?>
                                        <div>
                                            <p class="product-text-box"><?= htmlspecialchars($product['name']) ?></p>
                                            
                                            <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" width="150" height="150">

                                            <p class="product-hover product-btn" data-modal="modal-img<?= htmlspecialchars($product['id']) ?>" onclick="modalOpen(event)">拡大</p>

                                            <div class='product-box-shadow'>
                                          
                                                <a href="./product_detail.php?id=<?= htmlspecialchars($product['id']) ?>">
                                                    <p class="product-btn2">ご予約はこちら</p>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>


                    </div>
                </section>
            </article>
            <!-- 
            <div class="banner-box banner-close-block">
                ...
            </div>
    
            <div class="banner-box2 banner-open-block">
                ...
            </div> -->


        </div>
    </div>

</body>

</html>