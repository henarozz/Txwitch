<?php
/**
 * Txwitch
 * 
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Txwitch\Model;

use Txwitch\Model\Channel;

/**
 * Stream Model Class
 * 
 * @package Txwitch\Model
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
     * 
     * @param Channel $channel
     */
    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
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

