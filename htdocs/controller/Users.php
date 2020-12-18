<?php

require __DIR__ . "/../config/config.php";
require __DIR__ . "/../assets/libraries/Controller.php";

?>

<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register($postData)
    {
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => '',
        ];

        # BACKEND STUFF
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // when btn clicked : check superglobal server
            // sanitize post data
            $postData = filter_var_array($postData, FILTER_SANITIZE_STRING); // removes data potentially harmfull to app

            $data = [
                'username' => trim($postData['username']),
                'email' => trim($postData['email']),
                'password' => trim($postData['password']),
                'confirmPassword' => trim($postData['confirmPassword']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i"; // check for password validation

            // Validate username on letters/numbers

            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username.';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters and numbers.';
            }

            // Validate email

            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email address.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) { // filters single variable with specific filter ; 2n para removes illegal characters from address
                $data['emailError'] = 'Please enter the correct format.';
            } else {
                // check if email exists
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email already taken.'; // defined in modele/User construct
                }
            }
            //Validate password on length and numeric values
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password.';
            } elseif (intval(strlen($data['password']) < 6)) {
                $data['passwordError'] = 'Password must be at least 8 characters.'; // adding var under nameValidation
            }
            // Validate confirm password
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
                }
            }
            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user from model function
                if ($this->userModel->register($data)) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong.');
                }
            }
        }
        $this->view('users/register', $data);
    }

    public function login($data, $session)
    {
        var_dump($session);
        if (isset($session["loggedin"]) && $session['loggedin']) {
            exit;
        }
        $username = $password = "";
        $username_err = $password_err = "";

        if (empty(trim($data["username"]))) {
            $username_err = "Please enter username";
        } else {
            $username = trim($data["username"]);
        }
        if (empty(trim($data["password"]))) {
            $password_err = "Please enter password";
        } else {
            $password = trim($data["password"]);
        }

        if (empty($username_err) && empty($password_err)) {
            $sql = "SELECT * FROM chat_accounts WHERE account_login= :username";

            $stmt = $this->userModel->login($sql, $data);

            if ($stmt['execute']) {
                if ($row = $stmt['fetch']) {
                    $id = $row['account_id'];
                    $username = $row['account_username'];
                    $hashed_password = $row['account_pass'];
                    if (password_verify($password, $hashed_password)) {
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["login"] = $username;
                        $this->userModel->connectToChat($data);
                    } else {
                        $password_err = "Incorrect password";
                    }
                }
            } else {
                $username_err = "Username does not exist";
            }
            unset($stmt);
        }
        unset($pdo);
        echo $password_err;
        echo $username_err;
    }

    public function logout($session)
    {
        $this->userModel->logout($session);
    }
}