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

//Create an instance of the Base Class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//Define a default root (home page)
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a personal information route
$f3->route('GET /personalInformation', function () {
//    echo "Hello WOrld";
    $view = new Template();
    echo $view->render('views/personalInformation.html');
});

//Define a profile route
$f3->route('GET /profile', function () {
    $view = new Template();
    echo $view->render('views/profile.html');
});

//Define an interests route
$f3->route('GET /interests', function () {
    $view = new Template();
    echo $view->render('views/interests.html');
});

//Define a summary route
$f3->route('POST /summary', function () {
    $view = new Template();
    echo $view->render('views/summary.html');
});
//Rune fat free
$f3->run();
