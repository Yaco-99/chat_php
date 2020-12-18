<?php

require "../../config/config.php";

?>

<?php
class Database
{
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $dbHandler;
    private $error;

    public function __construct()
    {
        $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );
        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
        // $pdo = new PDO('mysql:host=mysqldb;dbname=my_database', 'root', 'root');
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // return $pdo;
    }

    //Allows us to write queries
    public function query($data)
    {
        $query = $this->dbHandler->prepare('INSERT INTO chat_accounts(account_login, account_email, account_pass) VALUES(:username, :email, :password)');
        $query->execute(array(
            ":username" => $data["username"],
            ":email" => $data["email"],
            ":password" => $data["password"],
        ));
        return;
    }

    public function login($sql, $data)
    {
        $stmt = $this->dbHandler->prepare($sql);
        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        $param_username = trim($data["username"]);
        $sqlRequest['execute'] = $stmt->execute();
        $sqlRequest['fetch'] = $stmt->fetch();
        return $sqlRequest;
    }

    public function insertToOnline($data)
    {
        $query = $this->dbHandler->prepare('INSERT INTO chat_online(online_user, online_status, online_time) VALUES(:online_user, :online_status, :online_time)');
        $query->execute(array(
            ":online_user" => $data["username"],
            ":online_status" => 2,
            ":online_time" => time(),
        ));
        return;
    }

    public function deleteToOnline($id)
    {
        $query = $this->dbHandler->prepare('DELETE FROM chat_online WHERE online_user = :online_user');
        $query->execute(array(
            ":online_user" => $id,
        ));
        return;
    }
/*
online_user
online_status
online_time */
    public function findEmail($sql, $email)
    {
        $query = $this->dbHandler->prepare($sql);
        $query->execute(array(
            ":email" => $email,
        ));
        return $query;
    }

    //Bind values
    public function bind($parameter, $value, $type = null)
    {
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($parameter, $value, $type);
    }

    //Execute the prepared statement
    public function execute()
    {
        return $this->statement->execute();
    }

    //Return an array
    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    //Return a specific row as an object
    public function single()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    //Get's the row count
    public function rowCount($rows)
    {
        return $rows->rowCount();
    }
}