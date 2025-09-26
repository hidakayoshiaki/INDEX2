<?php
include "./db.php";
$db = new DbConnection;
$pdo = $db->connect();

$keyword = $_GET['q'];

$stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ? ");
$searchWord = '%' . $keyword . "%";
$stmt->execute([$searchWord, $searchWord]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検索結果</title>
</head>

<body>
    <h1>「<?= htmlspecialchars($keyword, ENT_QUOTES) ?>」の検索結果</h1>

    <?php if (isset($results)): ?>
        <?php foreach ($results as $item): ?>
            <div>
                <p><?= htmlspecialchars($item['name'], ENT_QUOTES) ?></p>
                <a href="side-product.php?item=<?= urlencode($item['id']) ?>">商品詳細へ</a>
                <br>
                <img src="<?= htmlspecialchars($item['image_url'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($item['name'], ENT_QUOTES) ?>" width="200">
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>該当する商品はありません。</p>
    <?php endif; ?>
</body>

</html>