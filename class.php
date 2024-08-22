<?php
//クラスの作成(プロパティ、メッソド、コンストラクタの定義する)
class Food{
  //プロパティ（オブジェクトのデータ）の定義　(public→クセス権・どこでも）
  public $name;
  public $price;
  
  //コンストラクタの定義（値の代入するコンストラクタ）
  public function __construct($name,$price){
    $this->name=$name;
    $this->price=$price;
  }
  public function show_price(){
    echo "price" . $this->price ."円<br>";
  }
}
//=========アニマル=====================-
class Animal{
  //プロパティ（オブジェクトのデータ）の定義　(public→クセス権・どこでも）
  public $name;
  public $heigh;
  public $weight;
  
  //コンストラクタの定義（値の代入するコンストラクタ）
  public function __construct($name,$heigh,$weight){
    $this->name=$name;
    $this->heigh=$heigh;
    $this->weight=$weight;
  }
  public function show_height(){
    echo "height . $this->height .cm<br>";
  }
}
// ==============================
//Foodクラス（設計図）のインスタンス化（new クラス）作法
$apple = new Food("Apple", 150);
//Animalクラス（設計図）のインスタンス化
$elephant = new Animal("Elephant", 300,5000);

//インスタンスの出力
print_r($apple);
print_r($elephant);

//================================
//Foodメソッド(オブジェクトが持つ関数）を実行（->アロー演算子）
$apple->show_price();
//Animalメソッドを実行
$elephant->show_height();

?>