<?php
$dsn = 'mysql:dbname=php_book_app;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root';

/*データベース（php My Admin)に接続。
try{}の中で例外（エラー）が発生する可能性があるコードを書く。*/
try {
  $pdo = new PDO($dsn, $user, $password);

  // （HTMLのフォームでの処理（受け取る）orderパラメータの値が存在すれば（並び替えボタンを押したときに受け取る）、その値を変数$orderに代入する
  //
  if (isset($_GET['order'])) {
    $order = $_GET['order'];
  } else {
    $order = NULL;
  }

  // keywordパラメータの値が存在すれば（商品名を検索したとき）、その値を変数$keywordに代入する    
  if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
  } else {
    $keyword = NULL;
  }

  // orderパラメータの値によってSQL文を変更する    
  if ($order === 'desc') {
//-- booksテーブルのbook_nameカラムを降順（DESC）で並び替え、その順番でid、name、ageカラムのデータを取得する
    $sql_select = 'SELECT * FROM books WHERE book_name LIKE :keyword ORDER BY updated_at DESC';;
  } else {
    $sql_select = 'SELECT * FROM books WHERE book_name LIKE :keyword ORDER BY updated_at ASC';
  }

  // SQL文を用意する
  $stmt_select = $pdo->prepare($sql_select);
  // SQLのLIKE句で使うため、変数$keyword（検索ワード）の前後を%で囲む（部分一致）
  // 補足：partial match＝部分一致
  $partial_match = "%{$keyword}%";

  // bindValue()メソッドを使って実際の値をプレースホルダにバインドする（割り当てる）
  $stmt_select->bindValue(':keyword', $partial_match, PDO::PARAM_STR);

  // SQL文を実行する
  $stmt_select->execute();
  // SQL文の実行結果を配列で取得する。（PDO::FETCH_ASSOC）は連想配列形式で取得。
  //PDOException という特定の例外（エラー）。（PDOを使用したデータベース操作で発生するエラー）をキャッチ。ブロック。
  $books = $stmt_select->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  exit($e->getMessage());
}
//取得したレコード（行）を探し出し（変数$productsに格納）この時エラーをキャッチしたらエラーメッセージを表示（getMessage()）実行の終了（exit）。
?>

<!------------- ここからHTMLレイアウト ---------------->
<!DOCTYPE html>

<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>書籍一覧</title>
  <link rel="stylesheet" href="css/style.css">

  <!-- Google Fontsの読み込み -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">

</head>

<body>
  <header>
    <nav>
      <a href="index.php">書籍管理アプリ</a>
    </nav>
  </header>
  <main>
    <article class="books">
      <h1>書籍一覧</h1>

      <?php
      // （商品の登録・編集・削除後）messageパラメータの値を受け取っていれば、それを表示する
      if (isset($_GET['message'])) {
        echo "<p class='success'>{$_GET['message']}</p>";
      }
      ?>

      <div class="books-ui">
        <div>
          <a  href="read.php?order=desc&keyword=<?= $keyword ?>">
            <img src="images/desc.png" alt="降順に並び替え" class="sort-img">
          </a>

          <a href="read.php?order=asc&keyword=<?= $keyword ?>">
            <img src="images/asc.png" alt="昇順に並び替え" class="sort-img">
          </a>

          <form action="read.php" method="get" class="search-form">
            <input type="hidden" name="order" value="<?= $order ?>">
            <input type="text" class="search-box" placeholder="書籍名で検索" name="keyword" value="<?= $keyword ?>">
          </form>
        </div>
        <!-- <input type="hidden>ユーザーには表示」されない隠しフィールド・IDや注文番号などの時-->
        <!-- name="order"（12行目と関連）name` 属性は、フォームが送信されたときにサーバー側でこのフィールドにアクセスするための識別子・PHP では、`$_POST['order']` または `$_GET['order']` を使って受け取ることができます-->
        <!-- `value` 属性は、この入力フィールドにセットされる値を指定します。 変数 `$order` の内容がそのまま HTMLに出力され、フォーム送信時にその値がサーバーに送信されます。-->
        <a href="create.php" class="btn">書籍登録</a>
      </div>
      <table class="books-table">
        <tr>
          <th>書籍コード</th>
          <th>書籍名</th>
          <th>単価</th>
          <th>在庫数</th>
          <th>ジャンルコード</th>
          <th>編集</th>
          <th>消去</th>
        </tr>

        <?php
        // 配列の中身を順番に取り出し、表形式で出力する。
        //`<td>{$book['book_code']}</td>` は、以下のように訳すことができます。「商品コードを表示するテーブルのセル」
        //具体的には：`{$book['book_code']}` は、PHPの配列 `$book` の中の `'book_code'` というキーに対応する値がHTMLテーブルのセル内に表示されるという意味です。
        foreach ($books as $book) {
          $table_row = "
            <tr>
              <td>{$book['book_code']}</td>
              <td>{$book['book_name']}</td>
              <td>{$book['price']}</td>
              <td>{$book['stock_quantity']}</td>
              <td>{$book['genre_code']}</td>
              <td><a href='update.php?id={$book['id']}'><img src='images/edit.png' alt='編集' class='edit-icon'></a></td>
              <td><a href='delete.php?id={$book['id']}'><img src='images/delete.png' alt='削除' class='delete-icon'></a></td>                
            </tr>
          ";
          echo $table_row;
        }
        ?>
      </table>
    </article>
  </main>

  <footer>
    <p class="copyright">&copy; 書籍管理アプリ All rights reserved.</p>
  </footer>
</body>

</html>