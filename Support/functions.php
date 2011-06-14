<?php

/**
 * Check if a file is binary.
 * Uses http://us.php.net/manual/en/ref.fileinfo.php
 * Falls back to checking an array of common bin file extensions
 *
 * @return void
 **/
function is_binary($filepath) {

    if(function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME);
        $info = explode('charset=', finfo_file($finfo, $filepath));
    
        return ('binary' == end($info));
    }

    //Fallback
    $binaryExtensions = array(
        'png', 'gif', 'jpg', 'jpeg',
        'eot', 'svg', 'ttf', 'woff',
        'swf'
    );
    $extension = pathinfo($filepath, PATHINFO_EXTENSION);

    return in_array($extension, $binaryExtensions);

}


/**
 * Request an Asset from Shopify
 *
 * @param string $api_key
 * @param string $password 
 * @param string $store
 * @param string $key Key of asset we are downloading
 * @return object Asset / false on failure
 **/
function get_asset($api_key, $password, $store, $key) {
    //Request Asset URL Template
    // %1: API KEY, %2: PASSWORD, %3: STORE, %4: ASSET NAME
    $requestUrl = sprintf('http://%1$s:%2$s@%3$s/admin/assets.json?asset[key]=%4$s',
                    $api_key, $password, $store, $key
                );

    $responseTxt = `curl -s -g '$requestUrl'`;
    $response = json_decode($responseTxt);

    if(is_object($response) && property_exists($response, 'asset')) {
        return $response->asset;
    } else {
        return false;
    }
}

/**
 * Send an theme asset to shopify
 * @param string $api_key
 * @param string $password 
 * @param string $store
 * @param string $xmlFile Path to the XML File with the contents to upload.
 * @return string
 **/
function send_asset($api_key, $password, $store ,$xmlFile) {

    $requestUrl = sprintf('http://%1$s:%2$s@%3$s/admin/assets.xml', 
            $api_key, $password, $store
        );

    // Right now, not bothering with dumping the full response/error handling. Will add if it becomes an issue. 
    //We just collect the http_code and will display message if it's Not 200
    $response = `curl --connect-timeout 15 -m 120 -w'%{http_code}' -s -X PUT --data-binary @"$xmlFile" -H 'Content-Type: application/xml' '$requestUrl'`;
    $response = trim($response);
    return $response;
}

/**
 * Remove an Asset from Shopify
 *
 * @param string $api_key
 * @param string $password 
 * @param string $store
 * @param string $key Key of asset we are downloading
 * @return object Asset / false on failure
 **/
function remove_asset($api_key, $password, $store, $key) {
    //Request Asset URL Template
    // %1: API KEY, %2: PASSWORD, %3: STORE, %4: ASSET NAME
    $requestUrl = sprintf('http://%1$s:%2$s@%3$s/admin/assets.json?asset[key]=%4$s',
                    $api_key, $password, $store, $key
                );
                
    $response = json_decode(`curl -w'%{http_code}' -X DELETE -s -g '$requestUrl'`);

    if($response == 200) {
        return true;
    } 
    return false;
}

/**
 * Calculate the asset key from a provided filepath.
 *
 * @param string $filepath filesystem to the asset of interest.
 * @return void
 **/
function calc_asset_key($filepath) {
    $assetKey = str_replace(TM_PROJECT_DIRECTORY.'/', '', $filepath);
    return $assetKey;
}
