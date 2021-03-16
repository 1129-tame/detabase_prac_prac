<?php
require_once __DIR__ . '/inc/functions.php'; //絶対パス化
include __DIR__ . '/inc/error_check.php'; //バリデーションを読み込む
//バリデーション
//add.phpにidのバリデーションを追加
if (empty($_POST['id'])) {
    echo "idを指定してください";
    exit;
}
if (!preg_match('/\A\d{0,11}\z/',$_POST['id'])) {
    echo "idが正しくありません";
    exit;
}

try {
    $dbh = db_open(); //作成した関数、データベースの読み込み
    $sql = "UPDATE books SET title=:title, isbn=:isbn, price=:price, publish=:publish, author=:author WHERE id=:id"; //データ更新のsql文
    $stmt = $dbh->prepare($sql);
    var_dump($stmt);
    echo '<br>';
    $acd = $_POST;
    var_dump($acd);
    echo '<br>';
    $price = (int) $_POST['price'];
    $id = (int) $_POST['id'];
    $stmt->bindParam(":title",$_POST['title'], PDO::PARAM_STR);
    $stmt->bindParam(":isbn" , $_POST['isbn'] , PDO::PARAM_STR);
    $stmt->bindParam(":price" , $price, PDO::PARAM_INT);
    $stmt->bindParam(":publish" , $_POST['publish'], PDO::PARAM_STR);
    $stmt->bindParam(":author" , $_POST['author'],PDO::PARAM_STR);
    $stmt->bindParam(":id", $_POST['id'], PDO::PARAM_INT); //追加

    $stmt->execute();
    echo "データが更新されました";
    echo "<a href='list.php'>リストへ戻る</a>";
} catch (PDOException $e) {
    echo "エラー！:" .str2html($e->getMessage()) . "<br>";
    //echo "エラー！: <br>"; 本番での書き方
    exit;
}