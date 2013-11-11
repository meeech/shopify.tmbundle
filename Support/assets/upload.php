<?php
$assetKey = calc_asset_key(getenv('TM_FILEPATH')); 

//if its an image file, throw an error message.
if(is_binary(getenv('TM_FILEPATH'))) {
    echo "*Error: This is an image file. Use Send Selected Assets to Shopify instead.";
    exit();
}

$filecontents = htmlspecialchars(file_get_contents('php://stdin'), ENT_QUOTES, 'UTF-8');
$reqData = sprintf($xmlDataTemp, $filecontents, $assetKey);

//Dump the xml into a tmp file
$xmlFile = tempnam('/tmp', 'foo').'.xml';
file_put_contents($xmlFile, $reqData);

$response = send_asset($api_key, $password, $store ,$xmlFile);

if('200' == response_code($response)) {

	/* Add by Dale Tournemille 2013. This invokes terminal-notifier (by Eloy Durán) and displays the success upload message using OS X Notification Center. */
	echo "Uploaded {$assetKey} to {$config->current}.";
	echo exec("/usr/local/bin/terminal-notifier -title 'File Uploaded' -message 'The file {$assetKey} has been uploaded to your {$config->current} theme on Shopify.' -sender com.macromates.TextMate.preview");

	
} else {
    // Not ideal, but it works. Problem (though not much of one ): 
    // response on a fail will return the full curl page: ie, shopify 404 full html, + error code at the bottom
    // Will robustify if it becomes an issue. 
    echo "*Error: Could not upload {$assetKey} to {$config->current}." ;
	echo exec("/usr/local/bin/terminal-notifier -title 'Upload Error' -message 'Houston, we have a problem. The file {$assetKey} was NOT uploaded to {$config->current}.' -sender com.macromates.TextMate.preview");
    output_error($response);
}
//And clean up
unlink($xmlFile);