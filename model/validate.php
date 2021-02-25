<?php
/* model/validate.php
 * Contains validation functions for dating app
 *
 */

class Validate
{
    private $_dataLayer;

    function __construct()
    {
        $this->_dataLayer = new DataLayer();
    }

    /**
     * validName checks to see that  string is all
     * alphabetic
     * REQUIRED
     * #param String $name
     * @return boolean
     */
    function validName($name){
        return !empty($name) && cypte_alpha($name);
    }

    /**
     * validAge checks to see that  an age is numeric
     * and between 17 and 118
     * REQUIRED
     * #param number $age
     * @return boolean
     */
    function validAge($age){
        if(is_numeric($age) && 18 <= $age && $age <= 118 ){
            return true;
        }
        return false;
    }

    /**
     * validPhone checks to see that a phone numer is valid
     * contains only numbers and is 10 characters long
     * REQUIRED
     * #param number $phone
     * @return boolean
     */
    function validPhone($phone){
        if(strlen($phone) > 10 && is_numeric($phone)){
            return true;
        }
        return false;
    }

    /**
     * validAEmail checks to see that an email address is valid
     * REQUIRED
     * #param String $email
     * @return boolean
     */
    function validEmail($email){

    }

    /**
     * validOutdoor checks each selected outdoor interest against
     * a list of valid options
     * OPTIONAL
     * #param list $choices
     * @return boolean
     */
    function validOutdoor($choices){

    }

    /**
     * validIndoor checks each selected indoor interest against
     * a list of valid options
     * OPTIONAL
     * #param list $choices
     * @return boolean
     */
    function validIndoor($choices){

    }
}