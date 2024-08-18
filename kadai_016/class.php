  class Food {
  private $name;
  private $price;

  public function __construct($name, $price) {
      $this->name = $name;
      $this->price = $price;
    }

    public function getName() {
      return $this->name;
      }

    public function getPrice() {
      return $this->price;
    }
  }

  class Animal {
    private $name;
    private $height;
    private $weight;

    public function __construct($name, $height, $weight) {
      $this->name = $name;
    $this->height = $height;
      $this->weight = $weight;
    }

  public function getName() {
    return $this->name;
    }

    public function getHeight() {
      return $this->height;
    }

    public function getWeight() {
    return $this->weight;
    }
  }

  $food = new Food('potato', 250);
  $animal = new Animal('dog', 60, 5000);

  echo $food->getName() . " " . $food->getPrice() . PHP_EOL;
  echo $animal->getName() . " " . $animal->getHeight();


