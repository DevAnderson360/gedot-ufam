<?php 
    require_once "../vendor/autoload.php";

    //preparo para user não acessar esse espaço atoa.

    #valida a sessao
    $access = new \App\Utility\Access();
    $access->alerta('Que feio!');
    $access->logOut();
    $access->redireciona("../");