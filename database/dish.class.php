<?php 
declare(strict_types=1);


class Dish{
    public ?int      $dishId;  
    public ?int      $menuId;
    public ?int      $categoryId;
    public ?string   $name;
    public ?float    $price;
    public ?string   $ingredients;
    public ?boolean  $isVegan;

    public function __construct(int $dishId, int $menuId, int $categoryId, string $name, float $price, string $ingredients, boolean $isVegan){
        $this->dishId = $dishId;
        $this->menuId = $menuId;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->price = $price;
        $this->ingredients = $ingredients;
        $this->isVegan = $isVegan;
    }

    static function getDishes(PDO $db, int $count) : array {
        $stmt = $db->prepare('SELECT DishId, MenuId, CategoryId, Name, Price, Ingredients, Vegan FROM Dish LIMIT ?' );
        $stmt->execute(array($count));

        $dishes = array();

        while($dish = $stmt->fetch()){
            $dishes[] = new Dish(
                $dish['dishId'],
                $dish['MenuId'],
                $dish['CategoryId'],
                $dish['Name'],
                $dish['Price'],
                $dish['Ingredients'],
                $dish['Vegan']
            );
        }

        return $dishes;
    }

    static function getDish(PDO $db, int $dishId) : Dish {
        $stmt = $db->prepare('SELECT DishId, MenuId, CategoryId, Name, Price, Ingredients, Vegan FROM Dish WHERE DishId = ?');
        $stmt->execute(array($dishId));

        $dish=$stmt->fetch();
        
        return new Dish(
            $dish['DishId'],
            $dish['MenuId'],
            $dish['CategoryId'],
            $dish['Name'],
            $dish['Price'],
            $dish['Ingredients'],
            $dish['Vegan']
        );
    }

    static function createDish(PDO $db, $name, $price, $ingredients, $vegan){
        $stmt = $db-> prepare('
        INSERT INTO Dish(Name, Price, Ingredients, Vegan) 
        VALUES(:Name, :Price, :Ingredients, :Vegan)'
         );

        $stmt->execute([
            ':Name'         => $restaurantName,
            ':Price'        => $review,
            ':Ingredients'  => $price
        ]); 
    }

}   

?>