<?php
require_once 'functions.php';
//バリデーション
if (empty($_POST['title'])) {
    echo "タイトルは必須です。";
    exit;
}
if (!preg_match('/\A[[:^cntrl:]]{1,200}\z/u' , $_POST['title'])) {
    echo "タイトルは200文字までです。";
    exit;
}
if (!preg_match('/\A\d{0,13}\z/u' , $_POST['isbn'])) {
    echo "ISBNは数字13桁までです。";
    exit;
}
if (!preg_match('/\A\d{0,6}\z/u' , $_POST['price'])) {
    echo "価格は数字6桁までです。";
    exit;
}
if (empty($_POST['pubulish'])) {
    echo "日付の入力は必須です。";
    exit;
}
if (!preg_match('/\A\d{4}-\d{1,2}-\d{1,2}\z/u' , $_POST['pubulish'])) {
    echo "日付のフォーマットが違います。";
    exit;
}
$date = explode('-' , $_POST['pubulish']);
if (!checkdate($date[1],$date[2],$date[0])) {
    echo "正しい日付を入力してください";
    exit;
}
if (!preg_match('/\A[[:^cntrl:]]{0,80}\z/u' , $_POST['author'])) {
    echo "著者名は80文字までです。";
    exit;
}
try {
    $user = "xxxxxxxxx";
    $password = "xxxxxxxxxx";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
    ]; //DSN データソース名
    $dbh = new PDO('mysql:host=localhost:3308;dbname=sample_db;', $user, $password, $opt);
    $sql = "INSERT INTO books (id,title,isbn,price,publish,author) VALUES (NULL, :title, :isbn,  :price, :publish, :author)";
    $stmt = $dbh->prepare($sql);
    var_dump($stmt);
    echo '<br>';
    $acd = $_POST;
    var_dump($acd);
    echo '<br>';
    $price = (int) $_POST['price'];
    $stmt->bindParam(":title",$_POST['title'], PDO::PARAM_STR);
    $stmt->bindParam(":isbn" , $_POST['isbn'] , PDO::PARAM_STR);
    $stmt->bindParam(":price" , $price, PDO::PARAM_INT);
    $stmt->bindParam(":publish" , $_POST['pubulish'], PDO::PARAM_STR);
    $stmt->bindParam(":author" , $_POST['author'],PDO::PARAM_STR);

    $stmt->execute();
    echo "データが追加されました";
    echo "<a href='connect1.php'>リストへ戻る</a>";
} catch (PDOException $e) {
    echo "エラー！:" .str2html($e->getMessage()) . "<br>";
    //echo "エラー！: <br>"; 本番での書き方
    exit;
}