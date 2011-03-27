<?php
$file_to_up = getenv('TM_FILEPATH');
//Trim to remove the \n, \r
$page_id = (int)trim(`xattr -p id {$file_to_up}`);
$page = array('page' => array(
    'body_html' => file_get_contents($file_to_up),
    'id' => $page_id
));

$payload = Escape::sh(json_encode($page));

$requestUrlTemp = 'http://%1$s:%2$s@%3$s/admin/pages/%4$s.json';
$requestUrl = sprintf($requestUrlTemp, $config->api_key, $config->password, $config->store, $page_id);
// 
$response = `curl --connect-timeout 20 -X PUT -s -g '$requestUrl' -H 'Content-Type: application/json' --data-binary $payload`;
var_dump(json_decode($response));
echo 'Page uploaded...';
/*

Hi

Looking here:

http://api.shopify.com/page.html#update

In the JSON request example given, id is shown as an int, but there's no concept of int's in a JSON payload - its all strings. 

Only bringing this up because I am trying to work with it, and not sure if the problem is me, or what the API is expecting.

thanks*/
