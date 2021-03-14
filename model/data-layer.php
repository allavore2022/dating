<?php

/**
 * model/data-layer.php
 * returns data for my app
 */

class DataLayer
{
    ////////////// DATING V FUNCTIONS /////////////////////

    private $_dbh;

    /**
     * DataLayer constructor that creates a new database object
     * @param $dbh
     */
    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    /**
     * insertMember() takes in a member object then stores it
     * to the database
     * @param $member
     */
    function insertMember($member)
    {
        //define the query
        $sql = "INSERT INTO member(fname, lname, age, gender, phone, email, state, seeking, bio, premium, interests)
        VALUES(:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :interests)";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(":fname", $member->getFname(), PDO::PARAM_STR);
        $statement->bindParam(":lname", $member->getLname(), PDO::PARAM_STR);
        $statement->bindParam(":age", $member->getAge(), PDO::PARAM_INT);
        $statement->bindParam(":gender", $member->getGender(), PDO::PARAM_STR);
        $statement->bindParam(":phone", $member->getPhone(), PDO::PARAM_STR);
        $statement->bindParam(":email", $member->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(":state", $member->getState(), PDO::PARAM_STR);
        $statement->bindParam(":seeking", $member->getSeeking(), PDO::PARAM_STR);
        $statement->bindParam(":bio", $member->getBio(), PDO::PARAM_STR);
        //if a member is a premium member then store it as a 1 in the database
        $premium = $member instanceof PremiumMember ? 1 : 0;
        $statement->bindParam(":premium", $premium, PDO::PARAM_INT);
        //if a member is a premium member then set interests as a list. If not save it as an empty string
        $interests = $premium ? $member->getInDoorInterests() . $member->getOutDoorInterests() : "";
        $statement->bindParam(":interests", $interests, PDO::PARAM_STR);

        //execute
        $statement->execute();
    }

    /**
     * getMembers() returns all the data from the member table
     * sorted by last name.
     * @return mixed
     */
    function getMembers()
    {
        //define the query
        $sql = "SELECT * FROM member ORDER BY lname";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //execute
        $statement->execute();

        //get the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * getMember() returns a specific member's information
     * from the database using their member_id
     * @param $member_id
     * @return mixed
     */
    function getMember($member_id)
    {
        //define the query
        $sql = "SELECT * FROM member WHERE member_id = :member_id";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //bind the parameters
        $statement->bindParam(":member", $member_id, PDO::PARAM_STR);

        //execute
        $statement->execute();

        //return the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    /**
     * getInterests() returns a member's interests from the database
     * using their id.
     * @param $member_id
     * @return mixed
     */
    function getInterests($member_id)
    {
        //define the query
        $sql = "SELECT interests FROM member WHERE member_id = :member_id";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //bind the parameters
        $statement->bindParam(":member", $member_id, PDO::PARAM_STR);

        //execute
        $statement->execute();

        //return the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
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