<?php

require __DIR__ . '/../modele/modele.php';
require __DIR__ . '/../modele/user.php';
require __DIR__ . '/message.php';

class Routes
{
    public function home()
    {
        require 'view/chat.php';
    }

}

function user_verified()
{
    return isset($_SESSION['id']);
}
