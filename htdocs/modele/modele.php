<?php

class DatabaseYannick
{
    public static function dbConnect()
    {
        $pdo = new PDO('mysql:host=sql7.freemysqlhosting.net;dbname=sql7382863', 'sql7382863', 'mrn39KIPpx');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    }

    public function message($pdo)
    {
        $sql = $pdo->prepare("
        SELECT id, user_id, time, text, account_id, account_login
        FROM messages
        LEFT JOIN chat_accounts ON chat_accounts.account_id = messages.user_id
        ORDER BY time ASC LIMIT 0,100
    ");
        $sql->execute();
        return $sql;
    }

    public function insert($table, $param, $valuesKeys, $values)
    {
        $insert = $pdo->prepare('
			INSERT INTO ' . $table . ' (' . implode(", ", $param) . ')
			VALUES(' . implode(", ", $valuesKeys) . ')
        ');
        $insert->execute($values);
    }

    public function update($pdo, $table, $set, $where, $values)
    {
        $update = $pdo->prepare('UPDATE ' . $table . ' SET ' . $set . ' WHERE ' . $where);
        $update->execute($values);
    }

    public function delete($pdo, $table, $where, $values)
    {
        $delete = $pdo->prepare('DELETE FROM ' . $table . ' WHERE ' . $where);
        $delete->execute($values);
    }

    public function online($pdo)
    {
        $sql = $pdo->prepare("
    SELECT online_id, online_user, online_status, online_time, account_id, account_login
    FROM chat_online
    LEFT JOIN chat_accounts ON chat_accounts.account_id = chat_online.online_user
    ORDER BY account_login
    ");
        $sql->execute();
        return $sql;

    }

    public function spamCheck($pdo)
    {
        $sql = $pdo->prepare("SELECT * FROM messages WHERE user_id = :user ORDER BY time DESC LIMIT 0,1");
        $sql->execute(array(
            'user' => $_SESSION['id'],
        ));
        return $sql;
    }

    public function insertMessage($user, $text, $pdo)
    {
        $insert = $pdo->prepare('
	INSERT INTO messages (user_id, time, text)
	VALUES(:user, :time, :text)
');
        $insert->execute(array(
            'user' => $user,
            'time' => time(),
            'text' => $text,
        ));
    }

    public function insertStatus($pdo, $status, $id)
    {
        $insert = $pdo->prepare('
		UPDATE chat_online SET online_status = :status WHERE online_user = :user
	');
        $insert->execute(array(
            'status' => $status,
            'user' => $id,
        ));
    }

}
