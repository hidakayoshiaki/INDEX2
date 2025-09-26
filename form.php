<?php
session_start();
$_SESSION['navigated_within_site'] = true;
?>


<DOCTYPE html>

    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/form.css" />
    </head>

    <body>
        <div class="form-center">
            <form action="user-information.php" method="POST">
                <p>会員登録</p>

                <div>
                    <p>ユーザー名を記入ください。</p>
                    <input type="text" name="username" placeholder="ユーザー名"><br>
                </div>

                <div>
                    <p>パスワードを記入ください。</p>
                    <input type="password" name="password"><br>
                </div>
                <input class="form-mt" type="submit" value="登録">
            </form>
            <p><a href="./login.php">ログイン画面</a></p>
            </p><a href="./product-page.php">トップページへ</a></p>
        </div>
    </body>


    </html>