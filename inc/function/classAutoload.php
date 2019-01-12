<?php
function classAutoload($class){
    global $path;
    include $path['class'].$class.".php";
}
spl_autoload_register("classAutoload");