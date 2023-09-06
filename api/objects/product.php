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

        return $stmt->fetchAll();
    }
}
