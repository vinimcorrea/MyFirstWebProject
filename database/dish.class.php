<?php 
declare(strict_types=1);


class Dish{
    public int       $dishId;
    public ?string   $name;
    public ?float    $price;
    public string    $ingredients;
    public ?bool     $isVegan;
    public ?int      $categoryId; 
    public int       $restaurantId; 

    public function __construct(int $dishId, string $name, float $price, string $ingredients, bool $isVegan, int $categoryId, int $restaurantId){
        
        $this->dishId       = $dishId;
        $this->name         = $name;
        $this->price        = $price;
        $this->ingredients  = $ingredients;
        $this->isVegan      = $isVegan;
        $this->categoryId   = $categoryId;
        $this->restaurantId = $restaurantId;
    }

    static function getDishes(PDO $db, int $count) : array {
        $stmt = $db->prepare('SELECT DishId, Name, Price, Ingredients, Vegan, CategoryId, RestaurantId  FROM Dish LIMIT ?' );
        $stmt->execute(array($count));

        $dishes = array();

        while($dish = $stmt->fetch()){
            $dishes[] = new Dish(
                $dish['DishId'],
                $dish['Name'],
                $dish['Price'],
                $dish['Ingredients'],
                (bool) $dish['Vegan'],
                $dish['CategoryId'],
                $dish['RestaurantId']
            );
        }

        return $dishes;
    }

    static function getRestaurantDishes(PDO $db, int $restaurantId) : array {
        $stmt = $db->prepare('
        SELECT DishId, Name, Price, Ingredients, Vegan, CategoryId, RestaurantId  
        FROM Dish
        WHERE RestaurantId = ?');
        $stmt->execute(array($restaurantId));

        $dishes = array();

        while($dish = $stmt->fetch()){
            $dishes[] = new Dish(
                $dish['DishId'],
                $dish['Name'],
                $dish['Price'],
                $dish['Ingredients'],
                (bool) $dish['Vegan'],
                $dish['CategoryId'],
                $dish['RestaurantId']
            );
        }

        return $dishes;
    }

    static function getDish(PDO $db, int $dishId) : Dish {
        $stmt = $db->prepare('SELECT DishId, Name, Price, Ingredients, Vegan, RestaurantId FROM Dish WHERE DishId = ?');
        $stmt->execute(array($dishId));

        $dish=$stmt->fetch();
        
        return new Dish(
            $dish['DishId'],
            $dish['Name'],
            $dish['Price'],
            $dish['Ingredients'],
            $dish['Vegan'],
            $dish['CategoryId'],
            $dish['RestaurantId']
        );
    }

    static function createDish(PDO $db, $name, $price, $ingredients, $vegan, $categoryId, $restaurantId){
        $stmt = $db-> prepare('
        INSERT INTO Dish(Name, Price, Ingredients, Vegan, CategoryId, RestaurantId) 
        VALUES(:Name, :Price, :Ingredients, :Vegan, :CategoryId, :RestaurantId)'
         );

        $stmt->execute([
            ':Name'         => $name,
            ':Price'        => $price,
            ':Ingredients'  => $ingredients,
            ':Vegan'        => (bool) $vegan,
            ':CategoryId'   => $categoryId, 
            ':RestaurantId' => $restaurantId 
        ]); 
    }

}   

?>