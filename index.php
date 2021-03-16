    <?php
    require_once __DIR__ . '/inc/functions.php';
    include __DIR__ . '/inc/header.php'; //外部ファイル化
    try {
        $dbh = db_open();
        $sql = 'SELECT * FROM books';
        $statement = $dbh->query($sql);
    ?>

    <table>
        <tr><th>更新</th><th>書籍名</th><th>ISBN</th><th>価格</th><th>出版日</th><th>著者名</th></tr>
        <?php while ($row = $statement->fetch()): //: = {
            ?> 
            <tr>
                <td><a href="edit.php?id=<?php echo (int) $row['id']; ?>">更新</a></td>
                <td><?php echo str2html($row['title']) ?></td>
                <td><?php echo str2html($row['isbn']) ?></td>
                <td><?php echo str2html($row['price']) ?></td>
                <td><?php echo str2html($row['publish']) ?></td>
                <td><?php echo str2html($row['author']) ?></td>
            </tr>
        <?php endwhile; // ; = }
         ?>
    </table>
            <a href="input.php">新規追加</a>
    <?php
    } catch (PDOException $e) {
        echo "エラー！:" .str2html($e->getMessage()) . "<br>";
        //echo "エラー！: <br>"; 本番での書き方
        exit;
    }
    ?>
<?php include __DIR__ . '/inc/footer.php';