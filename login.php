<?php
session_start();
// サイト内を移動したことをセッションに記録
$_SESSION['navigated_within_site'] = true;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/login.css">
    <title>ログイン</title>
</head>

<body>
    <h1>ログイン画面</h1>
    <div class="login-width">
        <div class="login-form-container">

            <form action="login-process.php" method="POST">
                <div>
                    <label for="username">ユーザー名:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="login-mt">
                    <label for="password">パスワード:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">ログイン</button>
            </form>
            <p><a href='./logout.php'>ログアウト</a></p>
            <p><a href="./form.php">新規登録はこちら</a></p>
            <p><a href='./product-page.php'>戻る</a></p>
        </div>
    </div>
</body>

</html>