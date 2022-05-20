<?php 
declare(strict_types=1);


class Dish{
    public int     $menuId;
    public int     $categoryId;
    public string  $name;
    public float   $price;
    public string  $ingredients;
    public string  $isVegan;

    public function __construct(int $menuId, int $categoryId, string $name, float $price, string $ingredients, string $isVegan){
        $this->menuId = $menuId;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->price = $price;
        $this->ingredients = $ingredients;
        $this->isVegan = $isVegan;
    }

    static function getDishes(PDO $db, int $count) : array {
        $stmt = $db->prepare('SELECT MenuId, CategoryId, Name, Price, Ingredients, Vegan FROM Dish LIMIT ?' );
        $stmt->execute(array($count));

        $dishes = array();

        while($dish = $stmt->fetch()){
            $dishes[] = new Dish(
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

    static function getDish(PDO $db, int $menuId, int $categoryId) : Dish {
        $stmt = $db->prepare('SELECT MenuId, CategoryId, Name, Price, Ingredients, Vegan FROM Dish WHERE MenuId = ? AND CategoryId = ?');
        $stmt->execute(array($menuId, $categoryId));

        $dish=$stmt->fetch();
        
        return new Dish(
            $dish['MenuId'],
            $dish['CategoryId'],
            $dish['Name'],
            $dish['Price'],
            $dish['Ingredients'],
            $dish['Vegan']
        );
    }

}


?>