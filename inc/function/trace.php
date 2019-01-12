<?php
function trace($array,$return=false,$mode="pre_array") {
    switch ($mode) {
        case "pre_array":
            echo "<pre>".print_r($array,true)."</pre>";
            break;
        case "json_pretty":
            echo "<pre>".json_encode($array, JSON_PRETTY_PRINT)."</pre>";
            break;
        case "json":
            header('Content-Type: application/json');
            echo json_encode($array);
            break;
        default:
            break;
    }
}
