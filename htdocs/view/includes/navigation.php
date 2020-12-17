<?php

    require "../../config/config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?php URLROOT ?>/assets/css/style.css"> 
    <!-- <link rel="stylesheet" href="htdocs/assets/css/kstyle.css"> -->
    <title>Document</title>
</head>
<body>
<nav class="top-nav">
    <ul>
        <li>
            <a href=" <?php echo URLROOT; ?>/pages/index">Home</a>
        </li>
        <li>
            <a href=" <?php echo URLROOT; ?>/pages/about">About</a>
        </li>
        <li>
            <a href=" <?php echo URLROOT; ?>/pages/project">Projects</a>
        </li>
        <li>
            <a href=" <?php echo URLROOT; ?>/pages/blog">Blog</a>
        </li>
        <li>
            <a href=" <?php echo URLROOT; ?>/pages/contact">Contact</a>
        </li>
        <li class="btn-login">
            <a href=" <?php echo URLROOT; ?>/users/login">Login</a>
        </li>
    </ul>
</nav>
</body>
</html>
