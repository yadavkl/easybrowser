<?php

// Error Reporting
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
if (is_file('config.php')) {
    require_once('config.php');
}

// Startup
require_once(DIR_SYSTEM . 'startup.php');

// Registry
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);

// Document
//$document = new Document();
//$registry->set('document', $document);
// Request
$request = new Request();
$registry->set('request', $request);

// Response
$response = new Response();
$registry->set('response', $response);

// Session
$session = new Session();
$registry->set('session', $session);

//Url
$url = new Url(HTTP_SERVER);
$registry->set('url', $url);

// Database
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);

//<Country detection
//$country = new Country($registry);
//$registry->set('country', $country);

//User
//$user = new User($registry);
//$registry->set('user', $user);

// Cache
$cache = new Cache('file');
$registry->set('cache', $cache);

//<Google youtube client
$gac = new Gac();
$registry->set('youtube', $gac);

//<check if mobile
//$mobile = new Mobile($registry);
//$registry->set('device',$mobile);

/* //<Will be opened for release version
if( !$mobile->isMobile()){
    $response->redirect("https://play.google.com/store/apps/details?id=applminds.mogo");
}*/

//<constants
//$constant = new Constant($registry);
//$registry->set('constant',$constant);

// Front
$controller = new Front($registry);
$action = "";
if (isset($request->get['route'])) {
    $action = new Action($request->get['route']);
}
$controller->dispatch($action, new Action('error/notfound'));
$response->output();