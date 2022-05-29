<?php
declare(strict_types=1);

class Restaurant {
    public ?int    $restaurantId;
    public ?string $restaurantName;
    public ?float  $review = 0;
    public ?string $price;
    public  int    $categoryId;

    public function __construct(int $restaurantId, string $restaurantName, 
                                        float $review, string $price, int $categoryId){
        
        $this->restaurantId   = $restaurantId;
        $this->restaurantName = $restaurantName;
        $this->review         = $review;
        $this->price          = $price;
        $this->categoryId     = $categoryId;
    }

    static function getRestaurants(PDO $db, int $count) : array{
        $stmt = $db->prepare('SELECT RestaurantId, RestaurantName, Review, Price, CategoryId FROM Restaurant LIMIT ?');
        $stmt->execute(array($count));

        $restaurants = array();
        while ($restaurant = $stmt->fetch()) {
            $restaurants[] = new Restaurant(
                $restaurant['RestaurantId'],
                $restaurant['RestaurantName'],
                $restaurant['Review'],
                $restaurant['Price'],
                $restaurant['CategoryId']
            );
        }

        return $restaurants;
    }

    function save($db){
        $stmt = $db->prepare('
            UPDATE Restaurant SET restaurantName = ?
            WHERE RestaurantId = ?');

        $stmt->execute(array($this->RestauratName, $this->id));
    }

    static function getRestaurant(PDO $db, int $id) : Restaurant {
        $stmt = $db->prepare('SELECT RestaurantId, RestaurantName, Review, Price, CategoryId FROM Restaurant WHERE RestaurantId = ?');
        $stmt->execute(array($id));

        $restaurant = $stmt->fetch();

        return new Restaurant(
            $restaurant['RestaurantId'],
            $restaurant['RestaurantName'],
            $restaurant['Review'],
            $restaurant['Price'],
            $restaurant['CategoryId']
        );
    }


    static function getOwnerRestaurant(PDO $db, string $id) : Restaurant {
        $stmt = $db->prepare('SELECT Restaurant.RestaurantId, RestaurantName, Review, Price, CategoryId 
        FROM Restaurant, RestaurantOwner 
        WHERE Restaurant.RestaurantId = RestaurantOwner.RestaurantId AND OwnerId = ?');
        $stmt->execute(array($id));

        $restaurant = $stmt->fetch();

        return new Restaurant(
            $restaurant['RestaurantId'],
            $restaurant['RestaurantName'],
            $restaurant['Review'],
            $restaurant['Price'],
            $restaurant['CategoryId']
        );
    }


    static function getRestaurantOwnerId(PDO $db, int $id) : string {
        $stmt = $db->prepare('SELECT OwnerId 
        FROM RestaurantOwner
        WHERE RestaurantId = ?');
        $stmt->execute(array($id));

        $ownerId = $stmt->fetch();

        return $ownerId['OwnerId'];
    }

    static function getOwnerRestaurants(PDO $db, string $id) : array {
        $stmt = $db->prepare('
        SELECT Restaurant.RestaurantId, RestaurantName, Review, Price, CategoryId
        FROM Restaurant, RestaurantOwner 
        WHERE Restaurant.RestaurantId = RestaurantOwner.RestaurantId 
        AND OwnerId = ?');
        $stmt->execute(array($id));

        $restaurants = array();
        while ($restaurant = $stmt->fetch()) {
            $restaurants[] = new Restaurant(
                $restaurant['RestaurantId'],
                $restaurant['RestaurantName'],
                $restaurant['Review'],
                $restaurant['Price'],
                $restaurant['CategoryId']
            );
        }

        return $restaurants;
    }




    static function createRestaurant(PDO $db, User $user, string $restaurantName,string $review, string $price, int $categoryId){
        
        $stmt = $db-> prepare('
        INSERT INTO Restaurant(RestaurantName, Review, Price, CategoryId) 
        VALUES(:RestaurantName, :Review, :Price, :CategoryId)'
         );

        if($stmt->execute([
            ':RestaurantName' => $restaurantName,
            ':Review'         => $review,
            ':Price'          => $price,
            ':CategoryId'     => $categoryId
        ])){
        echo "Succesful added record";
        } else{
            echo "Error while adding record";
        }

        $stmt = $db-> prepare('
        INSERT INTO RestaurantOwner(OwnerId, RestaurantId) 
        VALUES(:OwnerId, :RestaurantId)'
         );

        $id = $db->lastInsertId();

         if($stmt->execute([
            ':OwnerId'       => $user->email,
            ':RestaurantId'  => $id,
        ])){
        echo "Succesful added record";
        } else{
            echo "Error while adding record";
        }

    }


}

?>