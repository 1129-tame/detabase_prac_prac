<?php include __DIR__ . '/inc/header.php'; ?>
    <form method="POST" action='add.php'>
        <p>
            <label　for="title">タイトル（必須・200文字まで）：</label>
            <input type="text" name='title'>
        </p>
        <p>
            <label for="isbn">ISBN(13桁までの数字)　：</label>
            <input type="text" name="isbn">
        </p>
        <p>
            <label for="price">定価（6桁までの数字）：</label>
            <input type="text" name="price">
        </p>
        <p>
            <label for="publish">出版日（YYYY-MM-DD形式）：</label>
            <input type="text" name="publish">
        </p>
        <p>
            <label for="author">著者（80文字まで）：</label>
            <input type="text" name="author">
        </p>
        <p class = 'button'>
            <input type="submit" value="送信する">
        </p>
        </form>
    <form action="index.php"　method="POST">
        <p>
            <input type="submit" value="リスト全表示">
        </p>
    </form>
<?php include __DIR__ . '/inc/footer.php';