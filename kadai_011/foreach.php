
    <?php
    //連想配列を作成
    $vegetable = [
      "名前" => "玉ねぎ",
      "値段" => 200,
      "産地"=> "北海道",
    ];
    //foreach文とecho文.＄variable_nameのキーと値をコロン（：）で区切り、要素ごとに改行して出力する   
    foreach ($vegetable as $key => $value) 
    {
      echo $key . ": " . $value .
      "<br>";
    }
  ?>