<?php
//Starting Session
$docroot=$_SERVER['DOCUMENT_ROOT'];
$functions=include "config/functions.php";
$path=include "config/path.php";
foreach ($functions as $key => $value) {
    include $path['function'].$value.".php";
}
$db=new database(getConfig("database"));
//Check table structure
if(setupRequired(getConfig("structure"),$db->tables())){
    include "setup.php";
    die;
}
if($_REQUEST['sesskey']??''!=''){
    $session=new session($_REQUEST['sesskey']);
}else{
    $session=new session();
}
$usr=$session->getUser();
if($usr!=''){
$user=json_decode($usr['userinfo'],true);
}else{
    $user="";
}
$response=Array();
$response['uinfo']=$user;
