#! /usr/bin/php
<?php 
// run the command, echo what needs echoing, and exit(0)
include getenv('TM_BUNDLE_SUPPORT').DIRECTORY_SEPARATOR.'head.php';

//Using C/A terminology
// c == folder name relative to support, a == filename.php
$controller = (isset($argv[1])) ? $argv[1] : null ; 
$action     = (isset($argv[2])) ? $argv[2] : null ; 
$id         = (isset($argv[3])) ? $argv[3] : null ; 

//Error check/handle - need to read up more on bash/cli
//will prolly have to decide on a convention i will follow for signaling
//success/error 

include getenv('TM_BUNDLE_SUPPORT').DIRECTORY_SEPARATOR.$controller.DIRECTORY_SEPARATOR.$action.".php";

exit(0);