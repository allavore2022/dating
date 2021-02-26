<?php

/**
 * model/data-layer.php
 * returns data for my app
 */

class DataLayer
{
    function getOutdoor()
    {
        return array("hiking", "biking", "swimming", "collecting", "walking", "climbing");
    }

    function getIndoor()
    {
        return array("tv", "movies", "cooking", "board games", "puzzle", "reading", "playing cards", "video games");
    }

    function getGender(){
        return array("male", "female");
    }
}