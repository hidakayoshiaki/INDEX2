<?php

// Webルートの外にあるdb.phpを読み込む
// __DIR__ はこのファイルのディレクトリを指す -> /home/portfolio001/public_html/index2
include __DIR__ . '/../server-db/db.php';

$db = new DbConnection();
$pdo = $db->connect();

try {
    // POSTリクエストでない場合は処理を中断
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: form.php');
        exit;
    }

    // 入力値のバリデーション
    if (empty($_POST['username']) || empty($_POST['password']) || trim($_POST['username']) === '' || trim($_POST['password']) === '') {
        echo "ユーザー名とパスワードは必須です。 <a href='form.php'>戻る</a>";
        exit;
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // パスワードの強度チェック（例：8文字以上）
    if (strlen($password) < 8) {
        echo "パスワードは8文字以上で設定してください。 <a href='form.php'>戻る</a>";
        exit;
    }

    // ユーザー名の重複チェック
    $stmt = $pdo->prepare("SELECT id FROM userdatatest WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        echo "そのユーザー名は既に使用されています。 <a href='form.php'>戻る</a>";
        exit;
    }

    // パスワードのハッシュ化
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // データベースへの登録
    $stmt = $pdo->prepare("INSERT INTO userdatatest(username, password ) VALUES(?, ?)");
    $stmt->execute([$username, $hashedPassword]);

    echo "登録が完了しました";
} catch (PDOException $e) {
    // 本番環境では、詳細なエラーメッセージはログファイルに記録する
    error_log($e->getMessage());
    // ユーザーには一般的なエラーメッセージを表示する
    echo "データベースエラーが発生しました。しばらくしてから再度お試しください。";
}

?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./node_modules/keen-slider/keen-slider.min.css" />
    </head>
    <body>
<a href="./login.php">ログインページへ</a>        
    </body>
</html>