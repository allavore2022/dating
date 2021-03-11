<?php

/**
 * model/data-layer.php
 * returns data for my app
 */

class DataLayer
{
    ////////////// DATING V FUNCTIONS /////////////////////

    private $_dbh;

    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    function insertMember()
    {

    }

    function getMembers()
    {

    }

    function getMember($member_id)
    {

    }

    function getInterests($member_id)
    {

    }

    /** getOutdoor() returns an array of outdoor activities
     *  @return array
     */
    function getOutdoor()
    {
        return array("hiking", "biking", "swimming", "collecting", "walking", "climbing");
    }

    /** getIndoor() returns an array of indoor activities
     *  @return array
     */
    function getIndoor()
    {
        return array("tv", "movies", "cooking", "board games", "puzzle", "reading", "playing cards", "video games");
    }

    /** getGender() returns an array of gender options
     *  @return array
     */
    function getGender()
    {
        return array("male", "female");
    }
}