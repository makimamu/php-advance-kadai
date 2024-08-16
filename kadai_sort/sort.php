<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>php基礎編</title>
  </head>

    <body>
      <p>
        <?php
        function sort_2way($array, $order){
          if ($order){
            sort($array);   //昇順ソート（並び替え）
          } else{
            rsort($array);  //降順ソート
          }
          return $array; //ソートされた配列を返す
        }

        //ソート（並び替え）する配列を宣言
        $nums = [15,4,18,23,10];

        //独自ソート関数を呼び出す


        //昇順ソート
        $nums = sort_2way($nums, true);
        echo "昇順にソートします。<br>";
        foreach ($nums as $num) {
        echo $num . "<br>";
        }

        //改行
        echo"<br>"; 

        //降順ソート
        $nums = sort_2way($nums, false);
        echo "降順にソートします。<br>";
        foreach ($nums as $num) {
        echo $num . "<br>";
        }
        ?>
      </p>
    </body>
</html>