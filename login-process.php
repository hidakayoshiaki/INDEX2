<?php
session_start();
include "./db.php";
$db = new DbConnection();
$pdo = $db->connect();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login-process.css">
    <title>Document</title>
</head>
<body>

<?php
try {


    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    $stmt = $pdo->prepare("SELECT * FROM userdatatest WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            echo "<div class='login-white-box'>";
            echo "<p>ログインに成功しました！</p>";
            echo "<a href='./product-page.php'>topページへ</a>";
            echo "</div>";
        } else {
            echo "パスワードが間違っています。<br>";
            echo "<a href='./login.php'>戻る</a>";
        }
    } else {
        // ユーザーが存在しない場合
        echo "ユーザー名が存在しません。<br>";
        echo "<a href='./login.php'>戻る</a>";
    }
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

?>
    
</body>
</html>