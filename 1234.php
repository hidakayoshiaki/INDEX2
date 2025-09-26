<?php

session_start();
include "./db.php";

$db = new DbConnection();
$pdo = $db->connect();


if (isset($_POST["btn2"])) {
    $testtest = $_POST["btn2"];
    $honbun = $_POST["honbun"];

    $stmt = $pdo->prepare("INSERT INTO test(name, article, created_at) VALUES(?, ?, NOW())");
    $stmt->execute([$testtest, $honbun]);

    // PRG二重投稿フォーム対策
    header('Location: 1234.php');
    exit;
}


$stmt2 = $pdo->prepare("SELECT * FROM test ORDER BY created_at DESC");
$stmt2->execute();
$results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/blog.css">
    <title>ブログ機能作成</title>
</head>

<body>

    <h2>投稿記事一覧:</h1>
        <p>投稿数:<?php
                $count = count($results2);

                echo $count
                ?></p>
        <ul>
            <?php
            echo "<div class='toukou-flex'>";
            foreach ($results2 as $toukou) {
                
                echo "<div class='toukou-block'>";
                echo "<li>" . htmlspecialchars($toukou['created_at'], ENT_QUOTES, 'UTF-8') . "</li>";
                echo "<li>" . htmlspecialchars($toukou['name'], ENT_QUOTES, 'UTF-8') . "</li>";
                echo "<li>" . htmlspecialchars($toukou['article'], ENT_QUOTES, 'UTF-8') . "</li>";
                echo "<a href='edit.php?id=" . htmlspecialchars($toukou['id'], ENT_QUOTES, 'UTF-8') . "'>編集する</a>";
                echo "</div>";
               
            }
             echo "</div>";
            ?>
        </ul>

        <p><a href="./123.php">戻る</a></p>
</body>

</html>