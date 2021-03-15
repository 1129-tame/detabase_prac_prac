<?php
require_once "functions.php";
//バリデーション
if (empty($_GET['id'])){
    echo "idを指定してください";
    exit;
} //値が入っているかどうか
if (!preg_match('/\A\d{1,11}+\z/u' , $_GET['id'])) {
    echo "idが正しくありません";
    exit;
} //数字11桁かどうか
$id = (int) $_GET['id'];
$dbh = db_open(); //データベースに接続
$sql = "SELECT id, title, isbn, price, publish, author FROM books WHERE id = :id"; //sql文を格納
$stmt = $dbh->prepare($sql); //データベースにsql文を入力
$stmt->bindParam(":id", $id, PDO::PARAM_INT); //プレースホルダーの値の置き換え
$stmt->execute(); //sql文の実行
$resolt = $stmt->fetch(PDO::FETCH_ASSOC); //データの取得、フィールド名がキーの配列にする
if (!$resolt) {
    echo "指定したデータはありません";
    exit; //1件も結果がなかったときの対処法
}
var_dump($resolt); //確認用のコード、後で削除
//取り出した値を入力
$title = str2html($resolt['title']);
$isbn = str2html($resolt['isbn']);
$price = str2html($resolt['price']);
$publish = str2html($resolt['publish']);
$author = str2html($resolt['author']);
$id = str2html($resolt['id']);
// フォーム上で表記
$html_form = <<<EOD
<form action='update.php' method='post'>
    <p>
        <label for='title'>タイトル：</label>
        <input type='text' name='title' value='$title'>
    </p>
    <p>
        <label for='isbn'>ISBN：</label>
        <input type='text' name='isbn' value='$isbn'>
    </p>
    <p>
        <label for='price'>価格：</label>
        <input type='text' name='price' value='$price'>
    </p>
    <p>
        <label for='publish'>出版日：</label>
        <input type='text' name='publish' value='$publish'>
    </p>
    <p>
        <label for='author'>著者：</label>
        <input type='text' name='author' value='$author'>
    </p>
    <p class = 'button'>
        <input type='hidden' name='id' value='$id'>
        <input type='submit'  value='送信する'>
    </p>
</form>
<form action ='list.php' method ='post'>
    <p>
        <input type='submit' value ='戻る'>
    </p>
</form>
EOD;
echo $html_form; //格納していたHTMLを出力