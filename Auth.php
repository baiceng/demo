<?php
require_once('db.php');

class auth
{
    public function __construct()
    {

    }

    public function register()
    {
        switch ($_POST['selected']) {
            case 'a':
                $p = 1;
                break;
            case 'b':
                $p = 2;
                break;
            case 'c';
                $p = 3;
                break;
        }
        $q = "INSERT INTO users (email, permission, first, last) VALUES ('{$_POST['email']}', '$p', '{$_POST['first']}', '{$_POST['last']}')";
        return db::getInstance()->insert_result($q);
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
