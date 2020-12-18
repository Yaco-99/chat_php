<?php
require_once 'controller.php';

$pdo = Database::dbConnect();
$db = new Database();
session_start();

$user = new User();
$data = $user->checkOnline($pdo, $_SESSION['id']);

if (user_verified()) {
    if ($data['count'] == 0) {
        $db->insert(
            "chat_online",
            array("online_id", "online_ip", "online_user", "online_status", "online_time"),
            array(":id", ":ip", ":user", ":status", ":time"),
            array(
                'id' => '',
                'ip' => $_SERVER["REMOTE_ADDR"],
                'user' => $_SESSION['id'],
                'status' => "2",
                'time' => time(),
            ));
    } else {
        $db->update($pdo, "chat_online", 'online_time = :time', "online_user = :user", array('time' => time(), 'user' => $_SESSION['id']));
    }
}

$time_out = time() - 5;
$db->delete($pdo, "chat_online", "online_time < :time", array('time' => $time_out));

//Status

$sql = $db->online($pdo);
$count = $sql->rowCount();

if ($count != 0) {
    $json['error'] = '0';

    $i = 0;
    while ($data = $sql->fetch()) {
        if ($data['online_status'] == '0') {
            $status = 'inactive';
        } elseif ($data['online_status'] == '1') {
            $status = 'busy';
        } elseif ($data['online_status'] == '2') {
            $status = 'active';
        }

        $infos["status"] = $status;
        $infos["login"] = $data['account_login'];
        $infos["id"] = $data['account_id'];

        $accounts[$i] = $infos;
        $i++;
    }

    $json['list'] = $accounts;
    $json['session'] = $_SESSION['id'];
} else {
    $json['error'] = '1';
}

$sql->closeCursor();

echo json_encode($json);
