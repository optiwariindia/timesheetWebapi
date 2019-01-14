<?php
$months=array_flip([
    "JAN",
    "FEB",
    "MAR",
    "APR",
    "MAY",
    "JUN",
    "JUL",
    "AUG",
    "SEP",
    "OCT",
    "NOV",
    "DEC"
]);

date_default_timezone_set('Asia/Kolkata');
//Checking if logged in with admin previllages
$error=[];
if(is_array($user)){
    switch($_REQUEST['action']){
        case 'showReportsDaily':
            $db->mode(1);
        break;

        case 'showReportsWeekly':
        	$db->mode(1);
            
        break;
         
        case 'showReportsMonthly':
            $db->mode(1);
            
        break;
         
        case 'addActivity':

			$db->mode(1);
            $r=$db->resa($_REQUEST);
            $date=explode(" ",$r['actDate']);
            $activity=[
                'actdate'=>$date[3]."-".($months[strtoupper($date[1])]+1)."-".$date[2]." ".$date[4],
                'activity'=>$r['activity'],
                'remarks'=>$r['remarks'],
                'added_by'=>$user['id'],
                'added_on'=>date('Y-m-d H:i:s', time())
            ];
            $status=$db->insert("timesheet",$activity);
            $response['activity']=$activity;
            $response['status']=$status;
        break;
         
        case 'updateActivity':
			$db->mode(1);
        break;

        case 'callExplanation':
            $db->mode(1);
        break;

        case 'replyExplanation':
        break;

        case 'getReport':
            $r=$db->resa($_REQUEST);
            $date=explode(" ",$r['repdate']);
            $d=$date[3]."-".($months[strtoupper($date[1])]+1)."-".$date[2];
            switch($r['reportType']){
                case 1:
                    $response['reports']=$db->select("timesheet","*","where date(actdate)='{$d}'");
                    $usrs=$db->select("user","id,loginid,name");
                    $usr=[];
                    for($i=0;$i<count($usrs);$i++){
                        $usr[$usrs[$i]['id']]=$usrs[$i];
                    }
                    $response['usersList']=$usr;
                    $response['days']=['JAN'=>31,'FEB'=>28,'MAR'=>31,'APR'=>30,'MAY'=>31,'JUN'=>30,'JUL'=>31,'AUG'=>31,'SEP'=>30,'OCT'=>31,'NOV'=>30,'DEC'=>31,'FEBL'=>29];
                break;;
                case 2:
                //Weekly Report
                break;;
                case 3:
                    $response['reports']=$db->select("timesheet","*","where month(actdate)=month('{$d}')");
                    //idea:select concat(year(added_on),LPAD(month(added_on),2,'0')),concat(year(added_on),'-',monthname(added_on)),count(*) from enquiry group by 1,2;
                break;;
            }
        break;
    }
}else{
    $response['error']="Authentication Required";
    $response['stat']='error';
    $response['auth']=false;
}
