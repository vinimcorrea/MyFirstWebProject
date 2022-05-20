<?php
declare(strict_types=1);

class Restaurant {
    public ?int    $restaurantId;
    public ?string $restaurantName;
    public ?string $street;
    public ?string $city;
    public ?string $province;
    public ?string $country;
    public ?float  $review;
    public ?string $price;
    public ?int    $ownerId;
    public ?int    $categoryId;

    public function __construct(int $id, string $restaurantName, string $street, string $city, string $province, string $country, float $review, string $price, int $ownerId, int $categoryId){
        $this->id = $id;
        $this->restaurantName = $restaurantName;
        $this->street = $street;
        $this->city = $city;
        $this->province = $province;
        $this->country = $country;
        $this->review = $review;
        $this->price = $price;
        $this->ownerId = $ownerId;
        $this->categoryId = $categoryId;

    }

    static function getRestaurants(PDO $db, int $count) : array{
        $stmt = $db->prepare('SELECT RestaurantId, RestaurantName, Street, City, Province, Country, Review, Price, OwnerId, CategoryId FROM Restaurant LIMIT ?');
        $stmt->execute(array($count));

        $restaurants = array();
        while ($restaurant = $stmt->fetch()) {
            $restaurants[] = new Restaurant(
                $restaurant['RestaurantId'],
                $restaurant['RestaurantName'],
                $restaurant['Street'],
                $restaurant['City'],
                $restaurant['Province'],
                $restaurant['Country'],
                $restaurant['Review'],
                $restaurant['Price'],
                $restaurant['OwnerId'],
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
        $stmt = $db->prepare('SELECT RestaurantId, RestaurantName, Street, City, Province, Country, Review, Price, OwnerId, CategoryId FROM Restaurant WHERE restaurantId = ?');
        $stmt->execute(array($id));

        $restaurant = $stmt->fetch();

        return new Restaurant(
            $restaurant['RestaurantId'],
            $restaurant['RestaurantName'],
            $restaurant['Street'],
            $restaurant['City'],
            $restaurant['Province'],
            $restaurant['Country'],
            $restaurant['Review'],
            $restaurant['Price'],
            $restaurant['OwnerId'],
            $restaurant['CategoryId']
        );
    }

}

?>