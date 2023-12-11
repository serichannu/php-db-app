<?php
$dsn = 'mysql:dbname=php_db_app;host=localhost;charset=utf8mb4';
$user ='root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password);

    if (isset($_GET['order'])) {
        $order = $_GET['order'];
    } else {
        $order = NULL;
    }

    if ($order === 'desc') {
        $sql_select = 'SELECT * FROM products ORDER BY updated_at DESC';
    } else {
        $sql_select = 'SELECT * FROM products ORDER BY updated_at ASC';
    }

    $stmt_select = $pdo->query($sql_select);

    $products = $stmt_select->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">    
</head>
<body>
    <header>
        <nav>
            <a href="index.php">商品管理アプリ</a>
        </nav>
    </header>
    <main>
        <article class="products">
            <h1>商品一覧</h1>
            <div class="products-ui">
                <div>
                    <a href="read.php?order=desc">
                        <img src="images/desc.png" alt="降順に並べ替え" class="sort-img">
                    </a>
                    <a href="read.php?order=asc">
                        <img src="images/asc.png" alt="昇順に並べ替え" class="sort-img">
                    </a>
                </div>
                <a href="#" class="btn">商品登録</a>
            </div>
            <table class="products-table">
                <tr>
                    <th>商品コード</th>
                    <th>商品名</th>
                    <th>単価</th>
                    <th>在庫数</th>
                    <th>仕入先コード</th>
                </tr>
                <?php
                foreach ($products as $product) {
                    $table_row = "
                    <tr>
                    <td>{$product['product_code']}</td>
                    <td>{$product['product_name']}</td>
                    <td>{$product['price']}</td>
                    <td>{$product['stock_quanity']}</td>
                    <td>{$product['vendor_code']}</td>
                    </tr>
                    ";
                    echo $table_row;
                }
                ?>
            </table>
        </article>
    </main>
    <footer>
        <p class="copyright">&copy; 商品管理アプリ All right reserved.</p>
    </footer>
</body>
</html>