<?php
class Product
{
    private $conn;
    private $table_name = "products";
    // object properties
    public $productId;
    public $productName;
    public $productDesc;
    public $productTitle;
    public $price;
    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT * FROM products ;";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

//        return json_encode($stmt->fetchAll());
        return $stmt;
    }

    function create(){

        $query = "INSERT INTO " . $this->table_name . "
            SET
                productName = :productName,
                productDesc = :productDesc,
                productTitle = :productTitle,
                price = :price";
        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->productName = htmlspecialchars(strip_tags($this->productName));
        $this->productDesc = htmlspecialchars(strip_tags($this->productDesc));
        $this->productTitle = htmlspecialchars(strip_tags($this->productTitle));
        $this->price = htmlspecialchars(strip_tags($this->price));

        // bind the values
        $stmt->bindParam(':productName', $this->productName);
        $stmt->bindParam(':productDesc', $this->productDesc);
        $stmt->bindParam(':productTitle', $this->productTitle);
        $stmt->bindParam(':price', $this->price);

        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
