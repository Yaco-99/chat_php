<?php

    require "../../config/config.php";

    require APPROOT . '/view/includes/head.php';
    echo 'lol';

    // need to link php files (#REQUIRE) in order for APPROOT to apply in index.php - otherwise returns error

?>

<div class="section-landing">
    <?php
        require APPROOT . '/view/includes/navigation.php';
    ?>
    <h1>Chat</h1>
    <h2>Allere</h2>
</div>