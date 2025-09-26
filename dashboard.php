<?php


session_start();

// ログインしていない場合はログインページにリダイレクト
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ダッシュボード</title>
</head>

<body>
    <h1>ダッシュボード</h1>
    <p>ようこそ、<?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES); ?>さん！</p>
    <a href="./product-page.php">商品ページへ</a>
</body>

</html>