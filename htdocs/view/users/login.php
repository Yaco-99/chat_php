<?php
session_start();
require "../../config/config.php";
require APPROOT . '/view/includes/head.php';
require "../../controller/Users.php";
require "../../controller/controller.php";
?>

<div class="navbar">
    <?php
        require APPROOT . '/view/includes/navigation.php';
    ?>
</div>

<div class="container-login">
    <div class="wrapper-login">
        <div class="sirWrap">
            <h2>Sign in</h2>
            <form method="POST" action="../../index.php">
            <!-- post for sensitive data of users -->
                <input type="text" placeholder="Username *" name="username">
                <span class="invalidFeedback">
                    <?php echo $data['usernameError']; ?>
                    <!-- Whenever user inputs wrong username (ie special characters) : sends error message format wrong -->
                </span>

                <input type="password" placeholder="Password *" name="password">
                <span class="invalidFeedback">
                    <?php echo $data['passwordError']; ?>
                </span>

                <button id="submit" type="submit" value="submit" name="submit">Submit</button>

                <p class="options">Not registered yet? <a href="register.php">Create an account!</a></p>
            </form>
        </div>
        <!-- This will make it go search for function *login* in controller/Users.php -->

<?php
    if (isset($_POST['submit'])) {

        $log = new Users();
        $log->login($_POST, $_SESSION);
        $route = new Routes;
        $route->home();
    }
?>
    </div>
</div>