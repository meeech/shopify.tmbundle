<?php
$assetKey = calc_asset_key(getenv('TM_FILEPATH')); 

//if its an image file, throw an error message.
if(in_array(pathinfo($assetKey, PATHINFO_EXTENSION), $imageExtensions)) {
    echo "*Error: This is an image file. Use Send Selected Assets to Shopify instead.";
    exit();
}

$filecontents = htmlentities(file_get_contents('php://stdin'), ENT_QUOTES, 'UTF-8');
$reqData = sprintf($xmlDataTemp, $filecontents, $assetKey);

//Dump the xml into a tmp file
$xmlFile = tempnam('/tmp', 'foo').'.xml';
file_put_contents($xmlFile, $reqData);

$response = send_asset($api_key, $password, $store ,$xmlFile);

if('200' == $response) {
    echo "Uploaded {$assetKey} to {$config->current}.";
} else {
    // Not ideal, but it works. Problem (though not much of one ): 
    // response on a fail will return the full curl page: ie, shopify 404 full html, + error code at the bottom
    // Will robustify if it becomes an issue. 
    echo "*Error: Could not upload {$assetKey} to {$config->current}." ;
}
//And clean up
unlink($xmlFile);