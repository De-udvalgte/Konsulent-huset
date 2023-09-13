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

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            trigger_error($e->getMessage(), E_USER_WARNING);
        }
        return $stmt;
    }

    function getById($id)
    {
        $query = "SELECT * FROM orders WHERE userId=" . $id;

        // prepare the query
        $stmt = $this->conn->prepare($query);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            trigger_error($e->getMessage(), E_USER_WARNING);
        }

        return $stmt;
    }

    function getByOrderId($orderId)
    {
        $query = "SELECT * FROM orders WHERE orderId=" . $orderId;

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

        // execute the query
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            trigger_error($e->getMessage(), E_USER_WARNING);
        }

        return $stmt->fetchColumn();
    }

    function ownsOrder($orderId, $userId)
    {
        $query = "SELECT * FROM orders WHERE orderId=" . $orderId . " AND userId =" . $userId;

        // prepare the query
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    function create()
    {

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
        try {
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            trigger_error($e->getMessage(), E_USER_WARNING);
        }
    }

    function delete($orderId)
    {

        $query = "DELETE FROM " . $this->table_name . " WHERE orderId=" . $orderId;
        // prepare the query
        $stmt = $this->conn->prepare($query);

        // execute the query, also check if query was successful
        try {
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            trigger_error($e->getMessage(), E_USER_WARNING);
        }
    }

    function deleteByUserId($userId)
    {

        $query = "DELETE FROM " . $this->table_name . " WHERE userId=" . $userId;
        // prepare the query
        $stmt = $this->conn->prepare($query);

        // execute the query, also check if query was successful
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function edit($orderId, $editedOrder)
    {

        $query = "UPDATE " . $this->table_name . "
                SET
                    productId = :productId,
                    startDate = :startDate,
                    endDate = :endDate,
                    address = :address
                WHERE
                    orderId = :orderId";

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
        $stmt->bindParam(':orderId', $orderId);

        // execute the query, also check if query was successful
        try {
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            trigger_error($e->getMessage(), E_USER_WARNING);
        }
    }
}
