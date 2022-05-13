<?php

class Customer{
    public int $id; 
    public string $password;
    public string $email;
    public string $firstName;
    public string $lastName;
    public string $mobile;
    public string $address;
    public string $city;
    public string $state;
    public string $country;
    public string $gender;
    public string $dateOfBirth;
    
    public function __construct(int $id, string $password, string $email, string $firstName, string $lastName, string $mobile, string $address, string $city, string $state, string $country, string $gender, string $dateOfBirth){
        $this->id = $id;
        $this->password = $password;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->mobile = $mobile;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->gender = $gender;
        $this->dateOfBirth = $dateOfBirth;
    }

    function name(){
        return $this->firstName . ' ' . $this->lastName;
    }

    function save($db){
        $stmt = $db->prepare('
            UPDATE Customer SET FirstName = ?, LastName = ?
            WHERE CustomerId = ?');

        $stmt->execute(array($this->firstName, $this->lastName, $this->id));
    }

    
    static function GetCustomerByEmail(PDO $db, string $email, string $password) : ?Customer{
        $stmt = $db-> prepare('
        SELECT CustomerId, Password, Email, FirstName, LastName, Mobile, Address, City, State, Country, Gender, DateOfBirth
        FROM Customer
        WHERE lower(email) = ? AND password = ? 
        ');

        $stmt->execute(array(strtolower($email), sha1($password)));

        if($customer = $stmt->fetch()){
            return new Customer(
                $customer['CustomerId'],
                $customer['Password'],
                $customer['Email'],
                $customer['FirstName'],
                $customer['LastName'],
                $customer['Mobile'],
                $customer['Address'],
                $customer['City'],
                $customer['State'],
                $customer['Country'],
                $customer['DateOfBirth']
            );
        }
        else return null;
    }

    static function getCustomer(PDO $db, int $id) : Customer {
        $stmt = $db->prepare('
          SELECT CustomerId, Password, Email, FirstName, LastName, Mobile, Address, City, State, Country, Gender, DateOfBirth
          FROM Customer 
          WHERE CustomerId = ?
        ');
  
        $stmt->execute(array($id));
        $customer = $stmt->fetch();
        
        return new Customer(
          $customer['CustomerId'],
          $customer['Password'],
          $customer['Email'],
          $customer['FirstName'],
          $customer['LastName'],
          $customer['Mobile'],
          $customer['Address'],
          $customer['City'],
          $customer['State'],
          $customer['Country'],
          $customer['Gender'],
          $customer['DateOfBirth']
        );
      }
}

?>