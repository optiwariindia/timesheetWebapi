<?php
//Checking if logged in with admin previllages
$error=[];
if(is_array($user)){
    switch($user['role']){
        case 1:
            switch($_REQUEST['action']){
                case 'list':
                    $db->mode(1);
                    $cnt=$db->select("user","count(*) as users");
                    $limit=$_REQUEST['limit']??10;
                    $page=$_REQUEST['page']??0;
                    $offset=$page*$limit;
                    $usr=$db->select('user','id,loginid,name,designation,department,role,active',"limit $offset,$limit");
                    $response['users']=$usr;
                    $pages=Array();
                    for($i=0;$i<ceil($cnt[0]['users']/10);$i++)
                    $pages[$i]=$i+1;
                    $response['pages']=$pages;
                break;

                case 'add':
					$db->mode(1);
                    date_default_timezone_set('Asia/Kolkata');
                    $r=$db->resa($_REQUEST);
                    $newuser=[
                        'loginid'=>$r['loginid'],
                        'name'=>$r['name'],
                        'designation'=>$r['designation'],
                        'department'=>1,
                        'role'=>1,
                        'active'=>1,
                        'passwd'=>md5($r['passwd']),
                        'added_by'=>$user['id'],
                        'added_on'=>date('Y-m-d H:i:s', time())
                    ];

                    if($db->select("user","count(*) as usrs","where loginid='{$newuser['loginid']}'")[0]['usrs']==1){
                        $status=["error"=>['msg'=>"user already exists",'type'=>'loginid'],'type'=>'error'];

                    }else{
                        $out=$db->insert("user",$newuser);
                        if($out['id']??-1>0){
                            $status=["type"=>"success"];
                        }else{
                            $status=["error"=>['msg'=>"There is some error",'type'=>'loginid'],'type'=>'error'];
                        }                           
                    }
                    $response['dbresp']=$db->select("user","count(*) as usrs","where loginid='{$newuser['loginid']}'");
                    $response['new-user']=$newuser;
                    $response['status']=$status;
                 break;
                 
                 case 'block':
					$db->mode(1);
					$r=$db->resa($_REQUEST);
                    $status=$response['dbresp']=$db->update("user",Array('active'=>false),"where loginid='{$r['loginid']}'");
                    $response['status']=$status;
                 break;
                 
                 case 'active':
					$db->mode(1);
					$r=$db->resa($_REQUEST);
                    $status=$response['dbresp']=$db->update("user",Array('active'=>true),"where loginid='{$r['loginid']}'");
                    $response['status']=$status;
                 break;
                 
                 case 'changePasswd':
					$db->mode(1);
					$r=$db->resa($_REQUEST);
					$status=$response['dbresp']=$db->update("user",Array('passwd'=>$r['passwd']),"where loginid='{$r['loginid']}'");
                    $response['status']=$status;
                 break;
                }
                break;
        default:
            break;
    }
}else{
    $response['error']="Authentication Required";
    $response['stat']='error';
    $response['auth']=false;
}
