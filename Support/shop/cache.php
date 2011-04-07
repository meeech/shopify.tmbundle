<?php 
// So not all template vars are necessarily available. 
// One possible solution, can create a special page on the live site which 
// then spits out all the template vars values, which we then cache.
//
// This script creates a JSON file with shop constructs so 
// we can load it when we do the preview functionality.
// Usually triggers after a switch, or when first init.
// Keep in mind, right now, rigged up to work with Pages. 
// Will approach more general pages later.
// linklists
// shop
// collections
// page_title
// template

//Start with Shop Info
$shop_info = json_decode(get_json('shop', $config->api_key, $config->password, $config->store));

// $custom_collections = json_decode(get_json('custom_collections', $config->api_key, $config->password, $config->store));
// affix products to custom_collections?

$cache = array();

// Fixes for expected variable values: http://wiki.shopify.com/Shop#shop.url
$shop_info->shop->url = 'http://'.$shop_info->shop->domain;
$shop_info->shop->permanent_domain = $shop_info->shop->domain;

$cache['shop'] = $shop_info->shop;

$shop_cache_file = TM_PROJECT_DIRECTORY.DIRECTORY_SEPARATOR.'.shop-cache.json';
file_put_contents($shop_cache_file, json_encode($cache));