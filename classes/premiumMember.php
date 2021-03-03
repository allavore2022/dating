<?php

/**
 * Class PremiumMember represents a premiumMember of a dating site
 *
 * The PremiumMember class is only accessible to members that check they want to
 * sign up for a premium membership. They then have access to our interests route that
 * utilizes these methods
 *
 * @author Alisa Llavore <allvore@mail.greenriver.edu>
 * @copyright 2021
 */

class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;

    /**
     * @return mixed
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param mixed $inDoorInterests
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * @return mixed
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param mixed $outDoorInterests
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }


}