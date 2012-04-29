<?php
// this param is mandatory, others are optional
$phpRackConfig = array(
    'dir' =>  __DIR__. DIRECTORY_SEPARATOR. 'rack-tests',
);
// absolute path to the bootstrap script on your server
include(__DIR__. DIRECTORY_SEPARATOR.'phpRack'. DIRECTORY_SEPARATOR.'bootstrap.php');