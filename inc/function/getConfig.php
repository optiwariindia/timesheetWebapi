<?php

function getConfig($configName) {
global $path;
return include $path['config'].$configName.".php";
}
