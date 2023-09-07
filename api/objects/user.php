<?php
class User
{
    private $conn;
    private $table_name = "users";

    public $userId;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $created;
    public $modified;
    public $rolesId;

    //constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
        SET
            firstName = :firstName,
            lastName = :lastName,
            email = :email,
            password = :password,
            rolesId = 1";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        //sanitize
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));


        // bind the values
        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':email', $this->email);


        //hash password, before saving
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);

        // execute the query, also check if query was successful
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // check if given email exist in the database
    function emailExists()
    {
        // query to check if email exists
        $query = "SELECT userId, firstName, lastName, email, password, rolesId
            FROM " . $this->table_name . "
            WHERE email = ?
            LIMIT 0,1";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->email = htmlspecialchars(strip_tags($this->email));

        // bind given email value
        $stmt->bindParam(1, $this->email);

        // execute the query
        $stmt->execute();

        // get number of rows
        $num = $stmt->rowCount();

        // if email exists, assign values to object properties for easy access and use for php sessions
        if ($num > 0) {

            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // assign values to object properties
            $this->userId = $row['userId'];
            $this->firstName = $row['firstName'];
            $this->lastName = $row['lastName'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->rolesId = $row['rolesId'];


            session_start();
            $_SESSION["userId"] = $this->userId;
            print(session_id());
            // return true because email exists in the database
            return true;
        }

        // return false if email does not exist in the database
        return false;
    }
}
