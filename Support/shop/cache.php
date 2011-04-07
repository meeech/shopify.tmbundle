<?php 
// This script creates a JSON file with shop constructs so 
// we can load it when we do the preview functionality.
// Usually triggers after a switch, or when first init.
// Collect stuff from http://wiki.shopify.com/Linklists
// linklists
// shop
// collections
// page_title
// template

$shop_info = json_decode(get_json('shop', $config->api_key, $config->password, $config->store));

$custom_collections = json_decode(get_json('custom_collections', $config->api_key, $config->password, $config->store));

//affix products to custom_collections

var_dump($custom_collections);


// $shop_cache_file = TM_PROJECT_DIRECTORY.DIRECTORY_SEPARATOR.'.shop-cache.json';
// file_put_contents($shop_cache_file, json_encode($allinfo));