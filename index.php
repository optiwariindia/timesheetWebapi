<?php
include 'conf.php';
$response['request']=$_REQUEST;

switch($_REQUEST['module']??''){
    case '':
        break;
    case 'login':
        include $path['modules']."login.php";
        break;
    case 'users':
        include $path['modules']."users.php";
        break;
    case 'reports':
        include $path['modules']."reports.php";
        break;
    default:
        
        break;
}
if(is_array($user)){
    $response['login']=$user;
}
include 'render.php';