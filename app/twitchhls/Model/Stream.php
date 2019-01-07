<?php
/**
 * TwitchHLS
 * 
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Twitchhls\Model;

use Twitchhls\Model\Channel;

/**
 * Stream Model Class
 * 
 * @package Twitchhls\Model
 */
class Stream
{
    /**
     *
     * @var Channel
     */
    protected $channel;
    
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
     * Getter method for <channel>
     * 
     * @return Channel model
     */
    public function getChannel()
    {
        return $this->channel;
    }
    
    /**
     * Setter method for <channel>
     * 
     * @param Channel $channel
     */
    public function setChannel(Channel $channel)
    {
        $this->channel = $channel;
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

