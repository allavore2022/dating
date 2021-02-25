<?php
/*
 * Alisa Llavore
 * January 27, 2021
 * This is the control page for my dating website
 */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Start a session
session_start();

//Instantiate my classes
$f3 = Base::instance();
$validator = new Validate();
$dataLayer = new DataLayer();
$controller = new Controller($f3);

$f3->set('DEBUG', 3);

//Define a default root (home page)
$f3->route('GET /', function () {
    global $controller;
    $controller->home();
});

//Define a personal information route
$f3->route('GET|POST /personalInformation', function() {
    global $controller;
    $controller->personalInformation();
});

//Define a profile route
$f3->route('GET|POST /profile', function() {
    global $controller;
    $controller->profile();
});

//Define an interests route
$f3->route('GET|POST /interests', function() {
    global $controller;
    $controller->interests();
});

//Define a summary route
$f3->route('GET|POST /summary', function() {

    global $controller;
    $controller->summary();
});
//Rune fat free
$f3->run();
