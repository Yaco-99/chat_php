<?php
require 'controller.php';

$pdo = DatabaseYannick::dbConnect();
$db = new DatabaseYannick();
session_start();

if (user_verified()) {
    if (isset($_POST['message']) and !empty($_POST['message'])) {
        $_POST['message'] = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        if (!preg_match("#^[-. ]+$#", $_POST['message'])) {
            $sql = $db->spamCheck($pdo);
            $count = $sql->rowCount();
            $data = $sql->fetch();

            if ($count != 0) {
                similar_text($data['message_text'], $_POST['message'], $percent);
            }

            if ($percent < 80) {
                if (time() - 5 >= $data['message_time']) {
                    $db->insertMessage($_SESSION['id'], $_POST['message'], $pdo);
                    echo true;
                } else {
                    echo 'Votre dernier message est trop récent. Baissez le rythme :D';
                }

            } else {
                echo 'Votre dernier message est très similaire.';
            }

        } else {
            echo 'Votre message est vide.';
        }

    } else {
        echo 'Votre message est vide.';
    }

} else {
    echo 'Vous devez être connecté.';
}
