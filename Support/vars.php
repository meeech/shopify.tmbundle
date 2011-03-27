<?php
include getenv('TM_BUNDLE_SUPPORT').DIRECTORY_SEPARATOR.'config.php';
$config = new mConfig(CONFIG_FILE_PATH);

// We use getenv instead of $_ENV since $_ENV may be turned off in people's systems. 
// Basically, just trying to be nice about it.
$api_key = $config->api_key;    //getenv('SHOPIFY_API_KEY');
$password = $config->password;  //getenv('SHOPIFY_PASSWORD');
$store = $config->store;        //getenv('SHOPIFY_STORE');

if(defined('PHP_WINDOWS_VERSION_MAJOR')) {
    $project_folder = getenv('TM_PROJECT_DIRECTORY');
    $project_folder = `cygpath -w '$project_folder'`; 
    define('TM_PROJECT_DIRECTORY', trim($project_folder));
} 
else {
	define('TM_PROJECT_DIRECTORY',getenv('TM_PROJECT_DIRECTORY'));
}

$imageExtensions = array('png', 'gif', 'jpg', 'jpeg');

// Ok, api has updated so you can PUT in json, but really no value in re-writing everything
// so sticking with xml till i have a compelling reason to switch yah? (hate for XML doesn't count as compelling :/ )
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
