<?php


session_start();

$_SESSION = array();
session_destroy();
$_SESSION['navigated_within_site'] = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/logout.css">
    <title>Document</title>
</head>

<body>
    <div class="logout-white-box">
        <p>ログアウトしました</p>
        <p><a href="./form.php">新規登録はこちら</a></p>
        <p><a href='./product-page.php'>戻る</a></p>
    </div>
</body>

</html>