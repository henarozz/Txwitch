<?php
/**
 * TwitchHLS
 * 
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Twitchhls\Component;

/**
 * Security Component Class
 * 
 * @package Twitchhls\Component
 */
class Security
{   
    /**
     * Method to pass authentication by auth credentials
     * 
     * @param array $trueAuthCredentials
     * @param array $userAuthCredentials
     * @return boolean
     */
    public function passAuth($trueAuthCredentials = [], $userAuthCredentials = [])
    {   
        if (
                $trueAuthCredentials === $userAuthCredentials &&
                (!empty($trueAuthCredentials) && !empty($userAuthCredentials))
        ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Method to set auth session to true=
     */
    public function setAuthSession()
    {
        $_SESSION['userIsAuthed'] = true;
    }
    
    /**
     * Method to unset auth session
     */
    public function unsetAuthSession()
    {
        if (!empty($_SESSION['userIsAuthed'])) {
            unset($_SESSION['userIsAuthed']);
        }
    }
    
    /**
     * Method to check authorization
     * 
     * @return boolean
     */
    public function isAuthed()
    {
        if (!empty($_SESSION['userIsAuthed']) && $_SESSION['userIsAuthed'] === true) {
            return true;
        } else {
            return false;
        }
    }
}