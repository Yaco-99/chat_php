<!-- LOGIN ok works so far -->

<?php
    require "../../config/config.php";
    require "../../controller/Users.php";
    
    require APPROOT . '/view/includes/head.php';
?>

<div class="navbar">
    <?php
        require APPROOT . '/view/includes/navigation.php';
    ?>
</div>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Register</h2>
        <form method="POST">
        <!-- post for sensitive data of users -->
            <input type="text" placeholder="Username *" name="username">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
                <!-- Whenever user inputs wrong username (ie special characters) : sends error message format wrong -->
            </span>
            
            <input type="email" placeholder="Email *" name="email">
            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>

            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>

            <input type="password" placeholder="Confirm Password *" name="confirmPassword">
            <span class="invalidFeedback">
                <?php echo $data['confirmPasswordError']; ?>
            </span>

            <button name="submit" id="submit" type="submit" value="submit">Submit</button>

            <p class="options">Not registered yet? <a href="<?php URLROOT; ?>/users/register">Create an account!</a></p>
        
        </form> 
        <!-- This will make it go search for function *login* in controller/Users.php -->
    </div>
    <?php
        if (isset($_POST["submit"])) {
            $newUser = new Users ();
            $newUser -> register($_POST);
        } 
        
    
    ?>
</div>