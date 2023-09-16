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
        $query = "SELECT * FROM " . $this->table_name;

        // prepare the query
        $stmt = $this->conn->prepare($query);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            trigger_error(getClientIP() . " || " . $e->getMessage() . "|| ", E_USER_WARNING);
        }

        return $stmt;
    }

    function get_by_id()
    {
        $query = "SELECT * 
            FROM 
                " . $this->table_name . " 
            WHERE 
                productId = ?
            LIMIT
                0,1";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->productId = htmlspecialchars(strip_tags($this->productId));

        // bind the values
        $stmt->bindParam(1, $this->productId);

        // execute query
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            trigger_error(getClientIP() . " || " . $e->getMessage() . "|| ", E_USER_WARNING);
        }

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->productName = $row['productName'];
        $this->productDesc = $row['productDesc'];
        $this->productTitle = $row['productTitle'];
        $this->price = $row['price'];

    }

    function create()
    {
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
        try {
            if ($stmt->execute()) {
                $this->productId = $this->conn->lastInsertId();
                return true;
            }
            return false;
        } catch (PDOException $e) {
            trigger_error(getClientIP() . " || " . $e->getMessage() . "|| ", E_USER_WARNING);
        }
    }

    function update()
    {
        // update query
        $query = "UPDATE " . $this->table_name . "
                SET
                    productName = :productName,
                    productDesc = :productDesc,
                    productTitle = :productTitle,
                    price = :price
                WHERE
                    productId = :productId";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->productName = htmlspecialchars(strip_tags($this->productName));
        $this->productDesc = htmlspecialchars(strip_tags($this->productDesc));
        $this->productTitle = htmlspecialchars(strip_tags($this->productTitle));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->productId = htmlspecialchars(strip_tags($this->productId));

        // bind the values
        $stmt->bindParam(':productName', $this->productName);
        $stmt->bindParam(':productDesc', $this->productDesc);
        $stmt->bindParam(':productTitle', $this->productTitle);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':productId', $this->productId);

        // execute the query
        try {
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            trigger_error(getClientIP() . " || " . $e->getMessage() . "|| ", E_USER_WARNING);
        }

    }

    function delete()
    {
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE productId = ?";
        print_r($query);
        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        //$this->productId = htmlspecialchars(strip_tags($this->productId));

        // bind id of record to delete
        $stmt->bindParam(1, $this->productId);

        // execute query
        try {
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            trigger_error(getClientIP() . " || " . $e->getMessage() . "|| ", E_USER_WARNING);
        }
    }
}