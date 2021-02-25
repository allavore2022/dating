<?php

class Controller
{
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function personalInformation()
    {
        $view = new Template();
        echo $view->render('views/personalInformation.html');
    }

    function profile()
    {
        //add global variables
        global $validator;
        global $dataLayer;

        //if the form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //get the data from the POST array
            $userFname = $_POST['fname'];
            $userLname = $_POST['lname'];
            $userGender = $_POST['gender'];
            $userAge = $_POST['age'];
            $userPhone = $_POST['pnumber'];

            //if the data is valid --> Store in session

            //validate first name
            if($validator->validFname($userFname)){
                $_SESSION['fname'] = $userFname;
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["fname"]', "Please enter a first name that only contains characters");
            }

            //validate last name
            if($validator->validLname($userLname)){
                $_SESSION['lname'] = $userLname;
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["lname"]', "Please enter a last name that only contains characters");
            }

            //validate gender
            if(isset($userGender)){
                $_SESSION['gender'] = $userGender;
            }

            //validate age
            if($validator->validAge($userAge)){
                $_SESSION['age'] = $userAge;
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["age"]', "Age has to be between 18 and 118");
            }

            //validate phone number
            if($validator->validPhone($userPhone)){
                $_SESSION['pnumber'] = $userPhone;
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["pnumber"]', "Phone number must be 10 digits long");
            }

            //if there are no errors, redirect to /profile
            if(empty($this->_f3->get('errors'))){
                $this->_f3->reroute('/profile');
            }
        }

        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function interests()
    {
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
    }

    function summary()
    {
        //add information from interest to summary
        if(isset($_POST['indoorInterests'])) {
            $_SESSION['indoorInterests'] = implode(", ", $_POST['indoorInterests']);
        }
        if(isset($_POST['outdoorInterests'])) {
            $_SESSION['outdoorInterests'] = implode(", ", $_POST['outdoorInterests']);
        }

        $view = new Template();
        echo $view->render('views/summary.html');
    }
}