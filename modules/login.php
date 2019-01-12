<?php
$r=$db->resa($_REQUEST);
  $db->mode(1);
  $stat=$db->select("user","id,loginid,name,designation,department,active,role,added_by,added_on","where loginid='{$r['user']}' and passwd=md5('{$r['passwd']}')");
  if(count($stat)==1){
      $sesskey=$session->setUser($stat[0]);
      $user=$stat[0];$user['sesskey']=$sesskey;
      $_SESSION['user']=$stat[0];
      $response['user']=$user;
      $response['status']='login successful';
      $response['auth']=true;
  }else{
      $response['stat']=$stat;
      $response['status']='login failed';
      $response['auth']=false;
  }