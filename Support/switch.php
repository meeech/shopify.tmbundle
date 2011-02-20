#! /usr/bin/php
<?php
/**
 * Switch your config to a different store
 *
 * @author Mitchell Amihod
 */
 
include getenv('TM_BUNDLE_SUPPORT').DIRECTORY_SEPARATOR.'ui.php';
include getenv('TM_BUNDLE_SUPPORT').DIRECTORY_SEPARATOR.'vars.php';

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

/*

$UI = new UI(getenv('DIALOG'));

$retval = $api->campaigns();
$oopsy->go($api->errorCode, $api->errorMessage, 'Unable to get list of Campaign!');

//pull out campaign info, prep it for TM 
$collector = array();
foreach($retval['data'] as $campaign){
    $temp = '{title="%s";campaign_id="%s";}';
    $collector[] = sprintf($temp, $campaign['title'], $campaign['id']);
}

$response = $UI->menu($collector);

if(empty($response)) {
    exit( 'Cancelled.');
}

$xml = new SimpleXMLElement($response);

for ($i=0; $i < count($xml->dict->key); $i++) { 
    if('campaign_id' == $xml->dict->key[$i]) {
        $config->campaign_id = $xml->dict->string[$i];
    }
}

$config->save();
*/
