<?php

echo "<h2>Downloading all pages from<br>{$config->store}</h2>";

$response = json_decode(get_json('pages', $config->api_key, $config->password, $config->store));

if(!is_object($response) || !property_exists($response, 'pages')) {
    echo "Error: Assets list not returned. Could just be a temporary error. Feel free to try again.<br>";
    echo "Req Url: {$requestUrl}";
    die();
}

$pages_path = TM_PROJECT_DIRECTORY.DIRECTORY_SEPARATOR.'pages';
if(!file_exists($pages_path)) {
    mkdir($pages_path);
}

foreach ($response->pages as $page) {
    $page_file_name = $pages_path.DIRECTORY_SEPARATOR.$page->handle.'.html';
    echo "Downloading {$page->title}<br>";
    file_put_contents($page_file_name, $page->body_html);

    //Here's where shit gets fun... just learnt about xattr
    `xattr -w id "{$page->id}" "{$page_file_name}"`;
    `xattr -w title "{$page->title}" "{$page_file_name}"`;
    `xattr -w template_suffix "{$page->template_suffix}" "{$page_file_name}"`;
}
echo 'Done.';