<?php
require 'controller.php';

session_start();
$pdo = Database::dbConnect();
$db = new Database();
if (user_verified()) {
    $db->insertStatus($pdo, $_POST['status'], $_SESSION['id']);
}
