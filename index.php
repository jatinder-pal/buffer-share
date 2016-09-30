<?php

// Required File Start.........
require __DIR__.'/connection.php'; //DB connectivity
// Required File END...........
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<h1>welcome to my app</h1>";
	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;
	require __DIR__.'/conf.php';
$access_token = shopify\access_token($_REQUEST['shop'], SHOPIFY_APP_API_KEY, SHOPIFY_APP_SHARED_SECRET, $_REQUEST['code']);
	$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token);
	try
	{
		# Making an API request can throw an exception
		$products = $shopify('GET /admin/products.json', array('published_status'=>'published'));
		print_r($products);
	}
	catch (shopify\ApiException $e)
	{
		# HTTP status code was >= 400 or response contained the key 'errors'
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
	catch (shopify\CurlException $e)
	{
		# cURL error
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}

?>

