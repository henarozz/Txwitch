<?php
/**
 * TwitchHLS
 * 
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Twitchhls\Model;

/**
 * Game Model Class
 * 
 * @package Twitchhls\Model
 */
class Game
{
    /**
     *
     * @var string
     */
    protected $id;
    
    /**
     *
     * @var string
     */
    protected $name;
    
    /**
     *
     * @var string
     */
    protected $boxArtUrl;
    
    /**
     * Game Model constructor
     *
     * @param string $id
     * @param string $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
    }
    
    /**
     * Getter method for <id> attribute
     * 
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Getter method for <name> attribute
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Getter method for <boxArtUrl> attribute
     * 
     * @return string
     */
    public function getBoxArtUrl()
    {
        return $this->boxArtUrl;
    }
    
    /**
     * Setter method for <boxArtUrl> attribute
     * 
     * @param string $url
     */
    public function setBoxArtUrl($url)
    {
        $this->boxArtUrl = $url;
    }
}

