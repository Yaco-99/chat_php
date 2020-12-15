<?php
require_once 'controller.php';

$pdo = Database::dbConnect();
$db = new Database();
session_start();

$_SESSION['id'] = 1;
$_SESSION['login'] = "test";

$user = new User();
$json['error'] = $user->checkUser($pdo, $_SESSION['id'], $_SESSION['login']);

$sql = $db->message($pdo);
$count = $sql->rowCount();

if ($count != 0) {
    $json['messages'] = '<div id="messages_content"><table><tr><td><table>';

    $messages = new Messages();
    $json['messages'] .= $messages->getMessages($sql);
    $json['messages'] .= '</table></td></tr></table></div>';
} else {
    $json['messages'] = 'Aucun message.';
}
echo json_encode($json);
$sql->closeCursor();
