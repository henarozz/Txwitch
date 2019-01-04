<?php
/**
 * TwitchHLS
 * 
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Twitchhls\Model;

/**
 * Channel Model Class
 * 
 * @package Twitchhls\Model
 */
class Channel
{
    /**
     *
     * @var string
     */
    protected $name;
    
    /**
     *
     * @var array
     */
    protected $playlist;
    
    /**
     * Channel Model constructor
     */
    public function __construct()
    {
        // empty
    }
    
    /**
     * Getter method for <name> attribute
     * 
     * @return string name of channel
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Setter method for <name> attribute
     * 
     * @param string $name of channel
     */
    public function setName($name = null)
    {
        $this->name = $name;
    }
    
    /**
     * Getter method for <playlist> attribute
     * 
     * @return array playlist of channel
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }
    
    /**
     * Setter method for <playlist> attribute
     * 
     * @param array $playlist of channel
     */
    public function setPlaylist(array $playlist = [])
    {
        $this->playlist = $playlist;
    }
}

