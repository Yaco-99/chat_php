<?php
require __DIR__ . "/../assets/libraries/Database.php";

class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $this->db->query($data);

        // Bind values

    }

    public function login($sql, $data)
    {
        return $this->db->login($sql, $data);
    }

    public function logout($session)
    {
        $this->db->deleteToOnline($session['id']);
        $_SESSION['logged'] = false;
        $_SESSION = array();
        session_destroy();
        return;
    }

    public function connectToChat($data)
    {
        $this->db->insertToOnline($data);
    }

    // Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email)
    {
        // Prepared statement
        $sql = $this->db->findEmail('SELECT * FROM chat_accounts WHERE account_email = :email', $email);

        //Check if email is already registered
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
