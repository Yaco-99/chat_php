<?php

    require "../../config/config.php";

    require APPROOT . '/view/includes/head.php';
    // echo 'lol';

    // need to link php files (#REQUIRE) in order for APPROOT to apply in index.php - otherwise returns error

?>

<div class="section-landing" id="section">
    <?php
        require APPROOT . '/view/includes/navigation.php';
    ?>
    <div class="wrapper-landing">
        <h1>Chat</h1>
        <h2>App</h2>
    </div>
</div>s