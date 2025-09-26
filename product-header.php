  <header class="product-header-flex">
      <h1 class="product-white-box h1-style-none"><a href="product-page.php">HOTELKAGOSIMA</a></h1>
      <nav class="nav-mt">
          <div class="product-flex2 ">
              <p class="product-white-box">ゲスト名：<?php
                                                if (isset($_SESSION['username'])) {
                                                    echo $_SESSION['username'];
                                                } ?></p>
              <div class="product-flex2 product-nav-box">
                  <p><a href="login.php">ログイン</a></p>
                  <p><a href="./form.php">新規登録はこちら</a></p>
                  <p><a href="./mycart.php">ご予約中のお部屋</a></p>
                  <p><a href="./order-history.php">ご予約履歴</a> </p>
              </div>
          </div>
      </nav>
  </header>