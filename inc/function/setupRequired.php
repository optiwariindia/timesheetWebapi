<?php
function setupRequired($tab1,$tab2) {
    $stat=false;
    for($i=0;$i<count($tab1);$i++){
        if(!in_array($tab1[$i],$tab2))
        {
            $stat=true;
        }
    }
    return $stat;
}
