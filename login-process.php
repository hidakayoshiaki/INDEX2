<?php
session_start();

// ログイン試行のエラーメッセージをセッションに保存するための準備
$_SESSION['login_error'] = '';

include __DIR__ . '/../server-db/db.php';
$db = new DbConnection();
$pdo = $db->connect();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: login.php');
        exit;
    }
    
    // 入力値の検証
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['login_error'] = 'ユーザー名とパスワードを入力してください。';
        header('Location: login.php');
        exit;
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM userdatatest WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // ユーザーが存在し、かつパスワードが一致する場合
    if ($user && password_verify($password, $user['password'])) {
        // セッションIDを再生成してセッションハイジャック対策
        session_regenerate_id(true);
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        header('Location: ./product-page.php');
        exit;
    } else {
      
        $_SESSION['login_error'] = 'ユーザー名またはパスワードが正しくありません。';
        header('Location: login.php');
        exit;
    }
} catch (PDOException $e) {
 
    error_log("Login Error: " . $e->getMessage());
    $_SESSION['login_error'] = 'データベースエラーが発生しました。しばらくしてから再度お試しください。';
    header('Location: login.php');
    exit;
}