<?php
declare(strict_types=1);

class Category {
    public int    $categoryId;
    public string $name;

    public function __construct(int $categoryId, string $name){
        
        $this->categoryId = $categoryId;
        $this->name = $name;

    }

    static function getCategories(PDO $db, int $count) : array{
        $stmt = $db->prepare('SELECT CategoryId, name FROM Category LIMIT ?');
        $stmt->execute(array($count));

        $categories = array();
        while ($category = $stmt->fetch()) {
            $categories[] = new Category(
                $category['CategoryId'],
                $category['name']
            );
        }

        return $categories;
    }

    function save($db){
        $stmt = $db->prepare('
            UPDATE Category SET name = ?
            WHERE CategoryId = ?');

        $stmt->execute(array($this->RestauratName, $this->id));
    }

    static function getCategory(PDO $db, int $id) : Category {
        $stmt = $db->prepare('SELECT CategoryId, name FROM Category WHERE CategoryId = ?');
        $stmt->execute(array($id));

        $category = $stmt->fetch();

        return new Category(
            $category['CategoryId'],
            $category['name']
        );
    }

}

?>