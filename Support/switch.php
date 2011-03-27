#! /usr/bin/php
<?php
/**
 * Switch your config to a different store
 *
 * @author Mitchell Amihod
 */
 
include getenv('TM_BUNDLE_SUPPORT').DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'ui.php';
include getenv('TM_BUNDLE_SUPPORT').DIRECTORY_SEPARATOR.'vars.php';

if(!file_exists(CONFIG_FILE_PATH)) {
    echo "You do not seem to be using a config file.";
    exit();
}

$shops = $config->read(CONFIG_FILE_PATH);

$collector = array();
foreach($shops as $k => $v){
    if('use' == $k) { continue; }
    $temp = '{title="%s";}';
    $collector[] = sprintf($temp, $k);
}

$UI = new UI(getenv('DIALOG'));
$response = $UI->menu($collector);

if(empty($response)) {
    exit( 'Cancelled.');
}

$xml = new SimpleXMLElement($response);

for ($i=0; $i < count($xml->dict->key); $i++) { 
    if('title' == $xml->dict->key[$i]) {
        $shops['use'] = (string)$xml->dict->string[$i];
    }
}

$config->save($shops);