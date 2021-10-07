<?php

$locals = [
    "login",
    'logged'
];

$log_inputs = true;
$logged = false;

if (isset($_POST['email'], $_POST['password'], $_POST['enviar'])){
    $email = filter_($_POST['email'], FILTER_SANITIZE_EMAIL);
    $passw = filter_($_POST['password']);

    if ($email){
        // ok
        $logged = true;
        $log_inputs = true;
    } else {
        // not ok, return error email
        echo '<script>alert(\'Email inválido\')</script>';
        $log_inputs = false;
    }
}

if ((!isset($_GET['local'])
or !in_array($_GET['local'], $locals)
or !$log_inputs) && !$logged)
    redirect(T_PATH . createQuery([
        ['local' => 'login']
    ]));
elseif ($logged){
    setcookie('lp_log', md5('logged until '.newtime(60, 2)), newtime(60, 2));
    redirect(T_PATH . createQuery([
        ['local' => 'logged']
    ]));
}

$log_cookie = (isset($_COOKIE['lp_log']) ? $_COOKIE['lp_log'] : false);

if (isset($_GET['local']) && $_GET['local'] === 'logged'){
    if (!$log_cookie){
        redirect(T_PATH . createQuery([
            ['local' => 'login']
        ]));
    }
}
