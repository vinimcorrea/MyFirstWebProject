<?php
declare(strict_types=1);

class Address {
    public ?int    $id;
    public ?string $restaurantName;
    public ?float  $review = 0;
    public ?string $price;
    public ?int    $ownerId;
    public ?int    $categoryId;
    public ?int    $addressId;

    public function __construct(int $id, string $restaurantName, float $review, string $price, int $ownerId, int $categoryId, int $addressId){
        
        $this->id = $id;
        $this->restaurantName = $restaurantName;
        $this->review     = $review;
        $this->price      = $price;
        $this->ownerId    = $ownerId;
        $this->categoryId = $categoryId;
        $this->addressId  = $addressId;
    }


    static function getAddress(PDO $db, int $id) : Restaurant {
        $stmt = $db->prepare('SELECT AddressId, AddressLineOne, AddressLineTwo, City, Country, postalcode FROM Address WHERE AddressId = ?');
        $stmt->execute(array($id));

        $address = $stmt->fetch();

        return new Address(
            $address['AddressId'],
            $address['AddressLineOne'],
            $address['AddressLineTwo'],
            $address['City'],
            $address['Country'],
            $restaurant['postalcode']
        );
    }

    
    
}
?>