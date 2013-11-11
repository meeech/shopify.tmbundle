<?php
// This one is just for Saving and Uploading a Text based file you working on. 
echo "<h2>Sending to {$config->current}</h2><h3>{$store}</h3>";

$selectedFiles = explode("' '",getenv('TM_SELECTED_FILES'));

foreach ($selectedFiles as $file) {

    $file = trim($file, "'");
    if(is_dir($file) || empty($file)) {
        continue;
    }

    $assetKey = calc_asset_key($file);

    //Get the extension
    $extension = pathinfo($assetKey, PATHINFO_EXTENSION);

    if(is_binary($file)) {
        $filecontents = base64_encode(file_get_contents($file));
        $reqData = sprintf($xmlDataTempImage, $filecontents, $assetKey);
    } else {
        $filecontents = htmlspecialchars(file_get_contents($file), ENT_QUOTES, 'UTF-8');
        $reqData = sprintf($xmlDataTemp, $filecontents, $assetKey);
    }

    //Dump the xml into a tmp file
    $xmlFile = tempnam('/tmp', 'foo').'.xml';
    file_put_contents($xmlFile, $reqData);

    echo "Sending asset: {$assetKey}...<br>";
    $response = send_asset($api_key, $password, $store ,$xmlFile);

    if('200' == response_code($response)) {
        echo "Uploaded: {$assetKey}<br>";
		echo exec("/usr/local/bin/terminal-notifier -title 'File Uploaded' -message 'The file {$assetKey} has been uploaded to Shopify.' -sender com.macromates.TextMate.preview");
    } else {
        // Not ideal, but it works. Problem (though not much of one ): 
        // response on a fail will return the full curl page: ie, shopify 404 full html, + error code at the bottom
        // Will robustify if it becomes an issue. 
        echo "*Error: Could not upload {$assetKey} to {$config->current}." ;
			echo exec("/usr/local/bin/terminal-notifier -title 'Upload Error' -message 'Houston, we have a problem. The file {$assetKey} was NOT uploaded to {$config->current}.' -sender com.macromates.TextMate.preview");
        output_error($response, array('line_break' => '<br>'));
    }
    //And clean up
    unlink($xmlFile);
}
echo 'Done.';
