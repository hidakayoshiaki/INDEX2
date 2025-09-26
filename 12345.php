
<?php

session_start();
include "./db.php";

$db = new DbConnection();
$pdo = $db->connect();

setcookie('name', 'testname', 0, "/", "", true, true);
$testname = $_COOKIE['name'];
if (isset($testname)) {

    echo $testname . '<br>';
};



$UserIp = $_SERVER['REMOTE_ADDR'];
$Access = $_SERVER['HTTP_USER_AGENT'];
print_r(
    $Access . '<br>'
);
echo $UserIp;


// $host = 'localhost';
// $dbname = 'test';
// $user ='root';
// $pass = '';


// $pdo = new PDO(
// "mysql:host="
// );


//  header('Content-Type: application/json; charset=UTF-8');

//     // numが存在するかつnumが数字のみで構成されているか
//     if(isset($_GET["num"]) && !preg_match('/[^0-9]/', $_GET["num"])) {
//         // numをエスケープ(xss対策)
//         $param = htmlspecialchars($_GET["num"]);
//         // メイン処理
//         $arr["status"] = "yes";
//         $arr["x114"] = (string)((int)$param * 114); // 114倍
//         $arr["x514"] = (string)((int)$param * 514); // 514倍
//     } else {
//         // paramの値が不適ならstatusをnoにしてプログラム終了
//         $arr["status"] = "no";
//     }

//     // 配列をjson形式にデコードして出力, 第二引数は、整形するためのオプション
//     print json_encode($arr, JSON_PRETTY_PRINT);

// namespace test;

echo "<br>";

$url = "https://www.sejuku.net/blog/";

//cURLセッションを初期化する
$ch = curl_init();

//URLとオプションを指定する
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

//URLの情報を取得する
$res =  curl_exec($ch);

//結果を表示する
var_dump($res);

//セッションを終了する
curl_close($ch);

$text2 = "yahho" . "nippon";

$text2 = str_replace("yahho", "hello", $text2);
echo $text2 . "<br>";

$x = "6";
if (abs(-$x) >= 2 * 3) {
    print "yes";
} else {
    print "no";
}
echo "<br>";

$directory = __DIR__; // 現在のディレクトリ
$phpFiles = glob($directory . '/*.php'); // PHPファイルを取得
$totalPhpFiles = count($phpFiles); // PHPファイルの総数

$testCount = 0; // $testが含まれるファイル数

foreach ($phpFiles as $file) {
    $content = file_get_contents($file); // ファイル内容を取得
    if (strpos($content, '$test') !== false) {
        $testCount++;
    }
}

echo "PHPファイルの総数: " . $totalPhpFiles . "<br>";
echo "文字列\$testが含まれるファイル数: " . $testCount . "<br>";

// 取得
if (isset($_COOKIE['names'])) {
    $names = explode(',', $_COOKIE['names']);
    echo count($names) . "<br>";

    if (count($names) > 9) {
        echo "testlplp" . "<br>";
    }

    foreach ($names as $name) {
        echo htmlspecialchars($name, ENT_QUOTES) . "<br>";
    };

    $names2 = explode(',', $_COOKIE['names2']);
    foreach ($names2 as $name2) {
        echo $name2 . "<br>";
    }


    print_r($_COOKIE);

    $num = null;

    for ($num = 1; $num <= 10; $num++) {
        if ($num % 3 == 0) {
            echo "a";
        } else if ($num % 5 == 0) {
            echo "b";
        } else if ($num % 8 == 0) {
            echo "c";
        } else {
            echo $num;
        }
    }
}

echo "<br>";

function calculate($a, $b = 5)
{
    return $a + $b;
}
echo calculate(3);

echo "<br>";

$array = array(1, 2, 3);

foreach ($array as $arrays) {
    echo $arrays;
}

$testName = "itizi nizi sanzi";


echo "<br>";

$mmoziretu = explode(" ", $testName);
foreach ($mmoziretu as $mozis) {
    echo  $mozis . "<br>";
}



// $test = [2,3,4];
// $test2 = array_shift($test);
// echo $test2;

$test = null;

$min = 0;
$max = 20;


class Test
{
    public $numsTest;

    function test100($test)
    {
        if ($test === null) {

            echo  "値なし";
        } elseif ($test != 5) {
            echo  $test . "外れ";
        } elseif ($test === 5) {
            echo  $test . " 当たり";
        }
    }
}

$test1001 = new Test();

if (isset($_POST["btn"])) {
    $test = rand($min, $max);
    $test1001->test100($test);
}

if (isset($_POST["syokika"])) {
    $test = null;
}

echo "<br>";

$bos = [

    "es" => "php",
    "tesw" => "php2"

];

echo http_build_query($bos);

echo "<br>" . phpversion();



echo "<br>";

$nametests = array(

    "atestname1" => "ckoko1",
    "btestname2" => "akoko2",
    "ctestname3" => "bkoko3",
    "dtestname4" => "dkoko4"
);

sort($nametests);

foreach ($nametests as $nametest) {
    echo $nametest;
}

echo  '<br>';


$testfiles = $_FILES;


foreach ($testfiles as $testfile) {
    echo $testfile;
}


echo    '<form action="./123.php" method="post">
        <button name="btn">ランダムボタン</button>
        <button name="syokika">初期化ボタン</button>
    </form>';



$mozitest = 'hello newworld';
echo strpos($mozitest, 'new');
echo '<br>';
echo str_replace('hello', 'Hello', $mozitest);


$truetest = in_array('hello newworld', [$mozitest]);
if ($truetest === true) {
    echo 'true';
} else {
    echo 'flase';
}
echo '<br>';

$mozinum = 1;
$mozinum = is_numeric($mozinum);
if ($mozinum === true) {
    echo 'true';
} else {
    echo 'flase';
}

echo '<br>';
$testboxs = [
    $testbox1 = 'こんにちは',
    $testbox2 = 'こんばんは',
    $testbox3 = 'おはよう',
    $testbox4 = 'ひさしぶり',
];
sort($testboxs);
array_push($testboxs, '一年ぶり');
array_pop($testboxs);
array_unshift($testboxs, '5年ぶり');
array_shift($testboxs);

echo count($testboxs);
echo '<br>';
foreach ($testboxs as $testbox) {
    echo $testbox;
}
echo '<br>';



$testarrays = array(
    'testarray1' => 'aiueo',
    'testarray2' => 'aiueo',
    'testarray3' => 'aiueo',
    'testarray4' => 'aiueo',
);



foreach ($testarrays as $keyaaa => $testarry) {
    echo $keyaaa . '<br>';
    echo $testarry . '<br>';
}
$testarraytrue = array_key_exists( 'testarray' , $testarrays);
if($testarraytrue){
    echo 'true';
}else{
    echo 'false';
}

$testarrayboxs = array_merge($testarrays, $testboxs);
foreach($testarrayboxs as $testarraybox){
    echo $testarraybox;
    echo '<br>';

}

$localnumname = is_readable(__FILE__);
if($localnumname){
echo 'true';
}else{
    echo 'false';
}

   echo '<br>';
$num123 = 'abcde';
$num123 = substr($num123,0,3 );
echo $num123 ;


// --- ここからPHPMailerを使ったメール送信機能 ---

// Composerのオートローダーを読み込む
require 'vendor/autoload.php';

// PHPMailerの名前空間を使用
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = '';
// フォームが送信されたら処理を開始
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_mail'])) {
    $mail = new PHPMailer(true);

    try {
        // --- サーバー設定 ---
        $mail->isSMTP();                                  // SMTPを使用
        $mail->Host       = 'smtp.gmail.com';             // SMTPサーバー (Gmailの場合)
        $mail->SMTPAuth   = true;                         // SMTP認証を有効にする
        $mail->Username   = 'lupin.sherlook@gmail.com'; // ★★★自分のGmailアドレス★★★
        $mail->Password   = 'YOUR_GMAIL_APP_PASSWORD';      // ★★★Gmailのアプリパスワード★★★
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   // TLS/SSL暗号化を有効にする
        $mail->Port       = 465;                          // TCPポート (SSLの場合は465)

        // --- 文字コード設定 ---
        $mail->CharSet = 'UTF-8';

        // --- 送信元・宛先設定 ---
        $mail->setFrom('lupin.sherlook@gmail.com', 'PHPからのテストメール'); // 送信元
        $mail->addAddress($_POST['to_email']); // 宛先

        // --- 内容設定 ---
        $mail->isHTML(false); // テキストメールとして送信
        $mail->Subject = $_POST['subject']; // 件名
        $mail->Body    = $_POST['body'];    // 本文

        $mail->send();
        $message = '<p style="color: green;">メールを送信しました。</p>';
    } catch (Exception $e) {
        // エラーが発生した場合
        $message = "<p style='color: red;'>メールの送信に失敗しました: {$mail->ErrorInfo}</p>";
    }
}
?>

<hr style="margin: 2em 0;">
<div style="font-family: sans-serif; padding: 1em; border: 1px solid #ccc; border-radius: 5px; margin-top: 20px;">
    <h2>PHPMailer メール送信テスト</h2>
    <p>※事前にコード内のGmail設定が必要です。</p>

    <?= $message ?>

    <form action="12345.php" method="POST">
        <div style="margin-bottom: 10px;">
            <label for="to_email">宛先:</label><br>
            <input type="email" id="to_email" name="to_email" size="40" required>
        </div>
        <div style="margin-bottom: 10px;">
            <label for="subject">件名:</label><br>
            <input type="text" id="subject" name="subject" size="40" required>
        </div>
        <div style="margin-bottom: 10px;">
            <label for="body">本文:</label><br>
            <textarea id="body" name="body" rows="5" cols="42" required></textarea>
        </div>
        <button type="submit" name="send_mail">メールを送信</button>
    </form>
</div>
