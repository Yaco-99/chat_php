<?php
class User
{
    public function checkUser($pdo, $id, $login)
    {
        $checkUser = $pdo->prepare("SELECT * FROM chat_accounts WHERE account_id = :id AND account_login = :login");
        $checkUser->execute(array(
            'id' => $id,
            'login' => $login,
        ));
        $countUser = $checkUser->rowCount();

        if ($countUser == 0) {
            $error = 'unlog';
            unset($_SESSION['time']);
            unset($_SESSION['id']);
            unset($_SESSION['login']);
        } else {
            $error = '0';
        }
        $checkUser->closeCursor();

        return $error;
    }

    public function checkOnline($pdo, $id)
    {
        $sql = $pdo->prepare("
	SELECT *
	FROM chat_online
	WHERE online_user = :user
    ");
        $sql->execute(array(
            'user' => $id,
        ));
        $count = count($sql);

        return array(
            'sql' => $sql->fetch(),
            'count' => $count,
        );
    }

    private function count($rows)
    {
        return $rows->rowCount();
    }

}
