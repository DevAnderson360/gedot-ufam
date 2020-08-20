<?php 
    require_once "../vendor/autoload.php";
    $log = new \App\Utility\Access();
    $log->alerta("Até mais, ".$_SESSION['user_shot_name']);
    $log->logOut();
    $log->redireciona("../");