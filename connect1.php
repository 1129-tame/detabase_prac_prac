<?php
require_once 'functions.php';
try {
    $user = "phpuser";
    $password = "uRZ89Tfw32H2PG9r";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
    ]; //DSN データソース名
    $dbh = new PDO('mysql:host=localhost:3308;dbname=sample_db;charset=utf8', $user, $password, $opt);
    var_dump($dbh);
    $sql = 'SELECT title, author FROM books';
    $statement = $dbh->query($sql);
    var_dump($statement);

    while ($row = $statement->fetch()) {
        echo "書籍名：" .str2html($row[0]) . "<br>";
        echo "著者名：" .str2html($row[1]) . "<br><br>";
    }
} catch (PDOException $e) {
    echo "エラー！:" .str2html($e->getMessage()) . "<br>";
    //echo "エラー！: <br>"; 本番での書き方
    exit;
}
   echo "<a href=add.html>ボタン</a>";
    

  