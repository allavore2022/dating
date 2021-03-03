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
        //add global variables
        global $validator;
        global $dataLayer;
        global $member;

        //get array
        $this->_f3->set('genders', $dataLayer->getGender());


        //if the form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //get the data from the POST array
            $userFname = $_POST['fname'];
            $userLname = $_POST['lname'];
            $userGender = $_POST['gender'];
            $userAge = $_POST['age'];
            $userPhone = $_POST['pnumber'];
            $isPremium = $_POST['isPremium'];

            //check to see if isPremium is checked and create object
            if(isset($isPremium)){
                $member = new PremiumMember($userFname, $userLname, $userAge, $userGender, $userPhone);
            } else {
                $member = new Member($userFname, $userLname, $userAge, $userGender, $userPhone);
            }

            //if the data is valid --> Store in session
            //validate first name
            if($validator->validFname($userFname)){
                //$_SESSION['fname'] = $userFname;
                $member->setFname($userFname);
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["fname"]', "Please enter a first name that only contains characters");
            }

            //validate last name
            if($validator->validLname($userLname)){
                //$_SESSION['lname'] = $userLname;
                $member->setLname($userLname);
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["lname"]', "Please enter a last name that only contains characters");
            }

            //validate gender
            if(isset($userGender)){
                //$_SESSION['gender'] = $userGender;
                $member->setGender($userGender);
            }

            //validate age
            if($validator->validAge($userAge)){
                //$_SESSION['age'] = $userAge;
                $member->setAge($userAge);
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["age"]', "Age has to be between 18 and 118");
            }

            //validate phone number
            if($validator->validPhone($userPhone)){
                //$_SESSION['pnumber'] = $userPhone;
                $member->setPhone($userPhone);
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["pnumber"]', "Phone number must be 10 digits long");
            }

            //if there are no errors, redirect to /profile
            if(empty($this->_f3->get('errors'))){
                $_SESSION['member'] = $member;
                $this->_f3->reroute('/profile');
            }
        }

        //make form sticky
        $this->_f3->set('userFname', isset($userFname) ? $userFname : "");
        $this->_f3->set('userLname', isset($userLname) ? $userLname : "");
        $this->_f3->set('userAge', isset($userAge) ? $userAge : "");
        $this->_f3->set('userGender', isset($userGender) ? $userGender : "");
        $this->_f3->set('userPhone', isset($userPhone) ? $userPhone : "");

        $view = new Template();
        echo $view->render('views/personalInformation.html');
    }

    function profile()
    {
        //add global variables
        global $validator;
        global $dataLayer;
        global $member;

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //get the data from the POST array
            $userEmail = $_POST['email'];
            $userState = $_POST['state'];
            $userSeeking = $_POST['seeking'];
            $userBio = $_POST['bio'];

            //validate email
            if($validator->validEmail($userEmail)){
//                $_SESSION['email'] = $userEmail;
                $_SESSION['member']->setEmail($userEmail);
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["email"]', "Email must contain an @.");
            }

            //validate state
            if(isset($userState)){
                //$_SESSION['state'] = $userState;
                $_SESSION['member']->setState($userState);
            }

            //validate seeking
            if(isset($userSeeking)){
//                $_SESSION['seeking'] = $userSeeking;
                $_SESSION['member']->setSeeking($userSeeking);
            }

            //validate bio
            if(isset($userBio)){
//                $_SESSION['bio'] = $userBio;
                $_SESSION['member']->setBio($userBio);
            }

            //if there are no errors, redirect to /profile
            if(empty($this->_f3->get('errors'))){
                if ($_SESSION['member'] instanceof PremiumMember) {
                    //                $_SESSION['member'] = $member;
                    $this->_f3->reroute('/interests');
                } else {
                    $this->_f3->reroute('/summary');
                }
            }
        }

        //get array
        $this->_f3->set('genders', $dataLayer->getGender());

        //make form sticky
        $this->_f3->set('userBio', isset($userBio) ? $userBio : "");
        $this->_f3->set('userSeeking', isset($userSeeking) ? $userSeeking : "");
        $this->_f3->set('userState', isset($userState) ? $userState : "");
        $this->_f3->set('userBio', isset($userBio) ? $userBio : "");

        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function interests()
    {
        //add global variables
        global $validator;
        global $dataLayer;

        //If the form has been submitted
        if ($_SERVER['REQUEST_METHOD']=='POST') {

            //get interests from post array
            $userIndoor = $_POST['indoorInterests'];
            $userOutdoor = $_POST['outdoorInterests'];

            //If condiments were selected
            //if(isset($_POST['indoor'])) {
            //if(isset($_POST['indoorInterests'])) {
                //validate indoor activities
                if(isset($userIndoor)) {
                    //Data is valid -> Add to session
                    if ($validator->validIndoor($userIndoor)) {
                        //$_SESSION['indoorInterests'] = implode(", ", $_POST['indoorInterests']);
                        $indoorList = implode(", ", $_POST['indoorInterests']);
                        $_SESSION['member']->setInDoorInterests($indoorList);
                    } //Data is not valid -> We've been spoofed!
                    else {
                        $this->_f3->set('errors["indoor"]', "Go away, evildoer!");
                    }
                }
//            }

            //validate outdoor activities
            if(isset($userOutdoor)) {
                //Data is valid -> Add to session
                if ($validator->validOutdoor($userOutdoor)) {
//                    $_SESSION['outdoorInterests'] = implode(", ", $_POST['outdoorInterests']);
                    $outdoorList = implode(", ", $_POST['outdoorInterests']);
                    $_SESSION['member']->setOutDoorInterests($outdoorList);
                } //Data is not valid -> We've been spoofed!
                else {
                    $this->_f3->set('errors["outdoor"]', "Go away, evildoer!");
                }
            }

            //If there are no errors, redirect user to summary page
            if (empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('/summary');
            }
        }

        //get arrays
        $this->_f3->set('indoor', $dataLayer->getIndoor());
        $this->_f3->set('outdoor', $dataLayer->getOutdoor());

        $view = new Template();
        echo $view->render('views/interests.html');
    }

    function summary()
    {

        $view = new Template();
        echo $view->render('views/summary.html');

        //clear session
        session_destroy();
    }
}