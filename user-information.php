<?php

include "./db.php";

$db = new DbConnection();
$pdo = $db->connect();

try {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO userdatatest(username, password ) VALUES(?, ?)");

    $stmt->execute([$username, $hashedPassword]);

    echo "登録が完了しました";
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./node_modules/keen-slider/keen-slider.min.css" />
    </head>
    <body>
<a href="./form.php">戻る</a>        
    </body>
</html>