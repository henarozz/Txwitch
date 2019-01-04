<?php
/**
 * TwitchHLS
 * 
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Twitchhls\Model;

/**
 * Stream Model Class
 * 
 * @package Twitchhls\Model
 */
class Stream
{
    /**
     *
     * @var string
     */
    protected $userId;
    
    /**
     *
     * @var string
     */
    protected $channelName;
    
    /**
     *
     * @var string
     */
    protected $thumbnailUrl;
    
    /**
     *
     * @var string 
     */
    protected $amountOfViewers;
    
    /**
     * Stream Model constructor
     */
    public function __construct()
    {
        // empty
    }
    
    /**
     * Getter method for <userId> attribute
     * 
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }
    
    /**
     * Setter method for <userId> attribute
     * 
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    
    /**
     * Getter method for <channelName> attribute
     * 
     * @return string
     */
    public function getChannelName()
    {
        return $this->channelName;
    }
    
    /**
     * Setter method for <channelName> attribute
     * 
     * @param string $channelName
     */
    public function setChannelName($channelName)
    {
        $this->channelName = $channelName;
    }
    
    /**
     * Getter method for <thumbnailUrl> attribute
     * 
     * @return string
     */
    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }
    
    /**
     * Setter method for <thumbnailUrl> attribute
     * 
     * @param string $thumbnailUrl
     */
    public function setThumbnailUrl($thumbnailUrl)
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }
    
    /**
     * Getter method for <amountOfViewers> attribute
     * 
     * @return string
     */
    public function getAmountOfViewers()
    {
        return $this->amountOfViewers;
    }
    
    /**
     * Setter method for <amountOfViewers> attribute
     * 
     * @param string $amountOfViewers
     */
    public function setAmountOfViewers($amountOfViewers)
    {
        $this->amountOfViewers = $amountOfViewers;
    }
}

