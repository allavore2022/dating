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
    function validFname($fname){
        return !empty($fname) && ctype_alpha($fname);
    }

    function validLname($lname){
        return !empty($lname) && ctype_alpha($lname);
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
        if(!empty($phone) && preg_match('/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', $phone)){
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
        return !empty($email) && preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $email);
    }

    /**
     * validOutdoor checks each selected outdoor interest against
     * a list of valid options
     * OPTIONAL
     * #param list $choices
     * @return boolean
     */
    function validOutdoor($selectedOutdoor){
        //Get valid condiments from data layer
        $validOutdoor = $this->_dataLayer->getOutdoor();

        //Check every selected condiment
        foreach ($selectedOutdoor as $selected) {

            //If the selected condiment is not in the valid list, return false
            if (!in_array($selected, $validOutdoor)) {
                return false;
            }
        }

        //If we haven't false by now, we're good!
        return true;
    }

    /**
     * validIndoor checks each selected indoor interest against
     * a list of valid options
     * OPTIONAL
     * #param list $choices
     * @return boolean
     */
    function validIndoor($selectedIndoor){
        //Get valid condiments from data layer
        $validIndoor = $this->_dataLayer->getIndoor();

        //Check every selected condiment
        foreach ($selectedIndoor as $selected) {

            //If the selected condiment is not in the valid list, return false
            if (!in_array($selected, $validIndoor)) {
                return false;
            }
        }

        //If we haven't false by now, we're good!
        return true;
    }
}