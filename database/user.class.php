<?php

class User{
    public int $id; 
    public string $password;
    public string $email;
    public string $firstName;
    public string $lastName;
    public string $mobile;
    public boolean $isOwner;
    
    public function __construct(int $id, string $password, string $email, string $firstName, string $lastName, string $mobile, boolean $isOwner){
        
        $this->id = $id;
        $this->password = $password;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->mobile = $mobile;
        $this->isOwner = $isOwner;
        
    }

    function name(){
        return $this->firstName . ' ' . $this->lastName;
    }

    function save($db){
        $stmt = $db->prepare('
            UPDATE User SET FirstName = ?, LastName = ?
            WHERE UserId = ?');

        $stmt->execute(array($this->firstName, $this->lastName, $this->id));
    }

    
    static function GetUserByEmail(PDO $db, string $email) : ? User{
        $stmt = $db-> prepare('
        SELECT Email, Password, FirstName, LastName, Mobile, isOwner
        FROM User
        WHERE lower(email) = ? 
        ');

        $stmt->execute(array(strtolower($email)));

        if($user = $stmt->fetch()){
            return new User(
                $user['Email'],
                $user['Password'],
                $user['FirstName'],
                $user['LastName'],
                $user['Mobile'],
                $user['IsOwner']
            );
        }
    }


    static function createUser(PDO $db, $email, $password, $firstName, $lastName, $mobile){
        $stmt = $db-> prepare('
        INSERT INTO User(Email, Password, FirstName, LastName, Mobile, IsOwner) 
        VALUES(:Email, :Password, :FirstName, :LastName, :Mobile, :IsOwner)'
         );

        if($stmt->execute([
            ':Email'     => $email,
            ':Password'  => $password,
            ':FirstName' => $firstName,
            ':LastName'  => $lastName,
            ':Mobile'    => $mobile,
            ':IsOwner'   => $isOwner
        ])){
        echo "Succesful added record";
        } else{
            echo "Error while adding record";
        }   
    }

    static function addUserAddress(PDO $db, $email, $addressOne, $addressTwo, $city, $country, $postalcode){
        $stmt = $db-> prepare('
            INSERT INTO Address(AddressLineOne, AddressLineTwo, City, Country, Postalcode)
            VALUES(:AddressLineOne, :AddressLineTwo, :City, :Country, :Postalcode)
        ');

        if($stmt->execute([
            ':AddressLineOne' => $addressOne,
            ':AddressLineTwo' => $addressTwo,
            ':City'           => $city,
            ':country'        => $country,
            ':postalcode'     => $postalcode
        ])){
            echo "New Address";
        } else {
            echo "error adding new address";
        }

        echo $db->lastInsertId();

        $addressId = $db->sqlite_last_insert_rowid();

        $stmt = $db-> prepare('
            INSERT INTO UserAddress(UserId, AddressId)
            VALUES(:UserId, :AddressId)
        ');
        
        $stmt->execute([
            ':UserId'    => $email,
            ':AddressId' => $addressId
        ]);    

    }
}

?>