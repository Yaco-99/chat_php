<?php
require __DIR__ . "/../assets/libraries/Database.php";

class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    } 

    public function register($data) {
        $this->db->query($data);

        // Bind values

    }

    // Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
        // Prepared statement
        $sql=$this->db->findEmail('SELECT * FROM users WHERE email = :email', $email);

        //Check if email is already registered
        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}