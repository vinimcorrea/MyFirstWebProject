<?php
declare(strict_types=1);

class Restaurant {
    public ?int    $restaurantId;
    public ?string $restaurantName;
    public ?float  $review = 0;
    public ?string $price;
    public ?int    $ownerId;
    public ?int    $categoryId;

    public function __construct(int $restaurantId, string $restaurantName, float $review, string $price, int $ownerId, int $categoryId){
        
        $this->restaurantId = $restaurantId;
        $this->restaurantName = $restaurantName;
        $this->review     = $review;
        $this->price      = $price;
        $this->ownerId    = $ownerId;
        $this->categoryId = $categoryId;
    }

    static function getRestaurants(PDO $db, int $count) : array{
        $stmt = $db->prepare('SELECT RestaurantId, RestaurantName, Review, Price FROM Restaurant LIMIT ?');
        $stmt->execute(array($count));

        $restaurants = array();
        while ($restaurant = $stmt->fetch()) {
            $restaurants[] = new Restaurant(
                $restaurant['RestaurantId'],
                $restaurant['RestaurantName'],
                $restaurant['Review'],
                $restaurant['Price']
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
        $stmt = $db->prepare('SELECT RestaurantId, RestaurantName, Review, Price FROM Restaurant WHERE RestaurantId = ?');
        $stmt->execute(array($id));

        $restaurant = $stmt->fetch();

        return new Restaurant(
            $restaurant['RestaurantId'],
            $restaurant['RestaurantName'],
            $restaurant['Review'],
            $restaurant['Price']
        );
    }




    static function createRestaurant(PDO $db, User $user, $restaurantName, $review, $price){
        
        $stmt = $db-> prepare('
        INSERT INTO Restaurant(RestaurantName, Review, Price) 
        VALUES(:RestaurantName, :Review, :Price)'
         );

        if($stmt->execute([
            ':RestaurantName' => $restaurantName,
            ':Review'         => $review,
            ':Price'          => $price
        ])){
        echo "Succesful added record";
        } else{
            echo "Error while adding record";
        }

        $stmt = $db-> prepare('
        INSERT INTO RestaurantOwner(OwnerId, RestaurantId) 
        VALUES(:OwnerId, :RestaurantId)'
         );

        $db->lastInsertId();

        $restaurantId = $db->sqlite_last_insert_rowid();

         if($stmt->execute([
            ':OwnerId'       => $user->userId,
            ':RestaurantId'  => $restaurantId,
        ])){
        echo "Succesful added record";
        } else{
            echo "Error while adding record";
        }

    }


}

?>