<?php

require "../../config/config.php";
require __DIR__ . "/../assets/libraries/Controller.php";

?>

<?php
class Users extends Controller {
    public function __construct() {
        $this->userModel = $this-> model('User');
    }

    public function register($postData) {
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
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
                'confirmPasswordError' => ''
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

    public function login() {
        $data = [
            'title' => 'Login page',
            'usernameError' => '',
            'passwordError' => '',
        ];

        $this->view('users/login', $data);
    }
}