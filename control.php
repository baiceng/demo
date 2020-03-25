<?php

session_start();

include_once('Auth.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: text/json; charset=utf-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if (isset($_GET['email'])) {
    $auth = new auth();
    if ($user = $auth->checkEmail()) {
        if (isset($_SESSION['permission']) && $_SESSION['permission'] < 1 || $_SESSION['uid'] == $user['uid']) {
            // 執行 redirect 方法
            $response['redirect'] = 'user//view.php';
        } else {
            session_unset();
            // 執行 redirect 方法
            $response['redirect'] = 'login.php';
        }
    } else {
        $response['reg'] = true;
    }
}

if (isset($_POST['email'])) {
    $auth = new auth();
    $response['mysql_insert'] = $auth->register();
}

// SESSION TEST IN HTML
if (isset($_GET['get_session'])) {
    if (isset($_GET['p'])) {
        $_SESSION['permission'] = $_GET['p'];
    }
    if (isset($_GET['u'])) {
        $_SESSION['uid'] = $_GET['u'];
    }
}

echo json_encode($response);
