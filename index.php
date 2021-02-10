<?php
/*
 * Alisa Llavore
 * January 27, 2021
 * This is the control page for my dating website
 */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

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
$f3->route('POST /profile', function () {
    //add information from personalInformation to Session array
    if(isset($_POST['fname'])){
        $_SESSION['fname'] = $_POST['fname'];
    }
    if(isset($_POST['lname'])){
        $_SESSION['lname'] = $_POST['lname'];
    }
    if(isset($_POST['gender'])){
        $_SESSION['gender'] = $_POST['gender'];
    }
    if(isset($_POST['age'])){
        $_SESSION['age'] = $_POST['age'];
    }
    if(isset($_POST['pnumber'])){
        $_SESSION['pnumber'] = $_POST['pnumber'];
    }

    $view = new Template();
    echo $view->render('views/profile.html');
});

//Define an interests route
$f3->route('POST /interests', function () {
    //add information from profile to session array
    if(isset($_POST['email'])){
        $_SESSION['email'] = $_POST['email'];
    }
    if(isset($_POST['state'])){
        $_SESSION['state'] = $_POST['state'];
    }
    if(isset($_POST['seeking'])){
        $_SESSION['seeking'] = $_POST['seeking'];
    }
    if(isset($_POST['bio'])){
        $_SESSION['bio'] = $_POST['bio'];
    }

    $view = new Template();
    echo $view->render('views/interests.html');
});

//Define a summary route
$f3->route('POST /summary', function () {

    //add information from interest to summary
    if(isset($_POST['indoorInterests'])) {
        $_SESSION['indoorInterests'] = implode(", ", $_POST['indoorInterests']);
    }
    if(isset($_POST['outdoorInterests'])) {
        $_SESSION['outdoorInterests'] = implode(", ", $_POST['outdoorInterests']);
    }

    $view = new Template();
    echo $view->render('views/summary.html');
});
//Rune fat free
$f3->run();
