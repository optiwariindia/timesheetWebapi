<?php

$setup=getConfig("dbsetup");

for($i=0;$i<count($setup);$i++){
    trace($db->query($setup[$i]));
}