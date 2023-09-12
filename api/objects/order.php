<?php
class Order
{
    private $conn;
    private $table_name = "orders";
    // object properties
    public $orderId;
    public $orderNumber;
    public $productId;
    public $userId;
    public $orderDate;
    public $startDate;
    public $endDate;
    public $address;

    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getAll()
    {
        $query = "SELECT * FROM orders";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function getById($id)
    {
        $query = "SELECT * FROM orders WHERE userId=" . $id;

        // prepare the query
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function getProdNameByOrderId($orderId)
    {
        $query = "SELECT p.productName FROM orders o INNER JOIN products p ON o.productId = p.productId WHERE o.orderId=" . $orderId;

        // prepare the query
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchColumn();
    }


    function create(){

        $query = "INSERT INTO " . $this->table_name . "
            SET
                orderNumber = :orderNumber,
                productId = :productId,
                userId = :userId,
                startDate = :startDate,
                endDate = :endDate,
                address = :address";
        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->orderNumber = htmlspecialchars(strip_tags($this->orderNumber));
        $this->productId = htmlspecialchars(strip_tags($this->productId));
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->startDate = htmlspecialchars(strip_tags($this->startDate));
        $this->endDate = htmlspecialchars(strip_tags($this->endDate));
        $this->address = htmlspecialchars(strip_tags($this->address));

        // bind the values
        $stmt->bindParam(':orderNumber', $this->orderNumber);
        $stmt->bindParam(':productId', $this->productId);
        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':startDate', $this->startDate);
        $stmt->bindParam(':endDate', $this->endDate);
        $stmt->bindParam(':address', $this->address);

        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function delete($orderId){

        $query = "DELETE FROM " . $this->table_name . " WHERE orderId=" . $orderId;
        // prepare the query
        $stmt = $this->conn->prepare($query);

        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function edit($orderId, $editedOrder){

        $query = "UPDATE " . $this->table_name . "
            SET
                productId = CASE WHEN `productId`='' or `productId` IS NULL THEN ':productId' END,
                startDate = CASE WHEN `startDate`='' or `startDate` IS NULL THEN ':startDate ' END,
                endDate = CASE WHEN `endDate`='' or `endDate` IS NULL THEN ':endDate ' END,
                address = CASE WHEN `address`='' or `address` IS NULL THEN ':address ' END" .
        " WHERE orderId=" . $this->orderId;

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->productId = htmlspecialchars(strip_tags($editedOrder->productId));
        $this->startDate = htmlspecialchars(strip_tags($editedOrder->startDate));
        $this->endDate = htmlspecialchars(strip_tags($editedOrder->endDate));
        $this->address = htmlspecialchars(strip_tags($editedOrder->address));

        // bind the values
        $stmt->bindParam(':productId', $this->productId);
        $stmt->bindParam(':startDate', $this->startDate);
        $stmt->bindParam(':endDate', $this->endDate);
        $stmt->bindParam(':address', $this->address);

        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }
        return false;
    }

}