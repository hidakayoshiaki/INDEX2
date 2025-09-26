<?php
session_start();
?>


<!DOCTYPE html>
<html lang="ja">


<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/side-product.css">
    <script src="./js/side-product.js" defer></script>
</head>


<body>
    <div class="product-text-right">
        <p>ゲスト名<?php if (isset($_SESSION['username'])) {
                    echo $_SESSION['username'];
                } ?></p>
        <p><a href="test-product-page.php">戻る</a></p>
    </div>

    <div class="product-flex">
        <div class="product-list-box">
            <p class="test" data-img="img-productA">testA</p>
            <p class="test" data-img="img-productB">testB</p>
            <p class="test" data-img="img-productC">testC</p>
            <p class="test" data-img="img-productD">testD</p>
            <p class="test" data-img="img-productE">testE</p>
        </div>
        <form action="./cart.php" method="POST">

            <div class="product-list-box-none" id="img-productA">
                <a href="./productA.php">
                    <img src="https://placehold.jp/150x150.png" alt="商品画像">
                    <p class="product-btn">商品をクリックし購入手続きへ</p>
                </a>
                <button type="submit" name="product" value="productA">お気に入りに入れる</button>
            </div>

            <div class="product-list-box-none" id="img-productB">
                <a href="./productA.php">
                    <img src="https://placehold.jp/100x150.png" alt="商品画像">
                    <p class="product-btn">商品をクリックし購入手続きへ</p>
                </a>
                <button type="submit" name="product" value="productB">お気に入りに入れる</button>
            </div>

            <div class="product-list-box-none" id="img-productC">
                <a href="./productA.php">
                    <img src="https://placehold.jp/150x100.png" alt="商品画像">
                    <p class="product-btn">商品をクリックし購入手続きへ</p>
                </a>
                <button type="submit" name="product" value="productC">お気に入りに入れる</button>
            </div>

            <div class="product-list-box-none" id="img-productD">
                <a href="./productA.php">
                    <img src="https://placehold.jp/200x200.png" alt="商品画像">
                    <p class="product-btn">商品をクリックし購入手続きへ</p>
                </a>
                <button type="submit" name="product" value="productD">お気に入りに入れる</button>
            </div>

            <div class="product-list-box-none" id="img-productE">
                <a href="./productA.php">
                    <img src="https://placehold.jp/300x300.png" alt="商品画像">
                    <p class="product-btn">商品をクリックし購入手続きへ</p>
                </a>
                <button type="submit" name="product" value="productE">お気に入りに入れる</button>
            </div>

        </form>
    </div>

</body>

</html>