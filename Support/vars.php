<?php

include getenv('TM_BUNDLE_SUPPORT').DIRECTORY_SEPARATOR.'config.php';
$config = new mConfig(CONFIG_FILE_PATH);

// var_dump($config);

// We use getenv instead of $_ENV since $_ENV may be turned off in people's systems. 
// Basically, just trying to be nice about it.
$api_key = $config->api_key;//getenv('SHOPIFY_API_KEY');
$password = $config->password;//getenv('SHOPIFY_PASSWORD');
$store = $config->store;//getenv('SHOPIFY_STORE');

if((false == $api_key) || (false == $password) || (false == $store)) {
    echo "Did you set up the Shell Variables? I can't seem to find your API Key, Password or Store.";
    exit();
}

if(defined('PHP_WINDOWS_VERSION_MAJOR')) {
    $project_folder = getenv('TM_PROJECT_DIRECTORY');
    $project_folder = `cygpath -w '$project_folder'`; 
    define('TM_PROJECT_DIRECTORY', trim($project_folder));
} 
else {
	define('TM_PROJECT_DIRECTORY',getenv('TM_PROJECT_DIRECTORY'));
}

$imageExtensions = array('png', 'gif', 'jpg', 'jpeg');

// A bit of a short cut. Would rather just work all in .json, but not sure if can PUT in .json
// %1: Data. , %2: ASSET NAME
$xmlDataTemp = '<?xml version="1.0" encoding="UTF-8"?>
<asset>
  <value>%1$s</value>
  <key>%2$s</key>
</asset>';

//Image XML
// %1: Data. , %2: ASSET NAME
$xmlDataTempImage = '<?xml version="1.0" encoding="UTF-8"?>
<asset>
  <attachment>%1$s</attachment>
  <key>%2$s</key>
</asset>';
