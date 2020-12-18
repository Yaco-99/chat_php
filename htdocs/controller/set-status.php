<?php
require 'controller.php';

session_start();
$pdo = DatabaseYannick::dbConnect();
$db = new DatabaseYannick();
if (user_verified()) {
    $db->insertStatus($pdo, $_POST['status'], $_SESSION['id']);
}
