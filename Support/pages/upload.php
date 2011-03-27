<?php
$file_to_up = getenv('TM_FILEPATH');
//Trim to remove the \n, \r
$page_id = (int)trim(`xattr -p id {$file_to_up}`);
$page = array('page' => array(
    'body_html' => file_get_contents($file_to_up)
));

$payload = Escape::sh(json_encode($page));

$requestUrlTemp = 'http://%1$s:%2$s@%3$s/admin/pages/%4$s.json';
$requestUrl = sprintf($requestUrlTemp, $config->api_key, $config->password, $config->store, $page_id);
// 
$response = `curl --connect-timeout 20 -X PUT -s -g '$requestUrl' -H 'Content-Type: application/json' --data-binary $payload`;

$response = json_decode($response);
if(!($page['page']['body_html'] === $response->page->body_html)) {
    echo 'Error... Try Again';
    return;
}
echo 'Uploaded to '.$config->store;
