<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>php基礎編</title>
  </head>
    <body>
      <p>
        <?php
        //functionから関数,{}まで
        function sort_2way(&$array, $order){
          if ($order) {
            echo "昇順にソートします。<br>";
            sort($array);   //昇順ソート（並び替え）
            
          }
          else{
            echo "降順にソートします。<br>";
            rsort($array);  //降順ソート（逆並び替え）
            }
          //ソート結果を表示
          foreach ($array as $value) {
          echo $value . "<br>";
          }
        }

        //ソート（並び替え）する配列を宣言
        $nums = [15,4,18,23,10];

        //関数の呼び出し

        //昇順ソート
        sort_2way($nums, true);
        //降順ソート
        sort_2way($nums, false);
        ?>
      </p>
    </body>
</html>