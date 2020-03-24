<?php
require_once('db.php');

class auth
{
    public function register($get)
    {

    }

    public function login($user)
    {
        if ($_SESSION['permission'] < 1 || $_SESSION['permission'] == $user['permission']) {
            header('Location: /user/view.php');
            exit();
        }
        header('Location: /login.php');
        exit();
    }

    public function checkEmail()
    {
        $q = "SELECT * FROM users WHERE email='{$_GET['email']}'";
        return db::getInstance()->get_result($q);
    }
}