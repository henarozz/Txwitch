<?php
/**
 * TwitchHLS
 * 
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Twitchhls\Mapper;

use Twitchhls\Component\EasyPDO;
use Twitchhls\Component\TwitchAPI;
use Twitchhls\Mapper\Mapper;
use Twitchhls\Model\Stream;

/**
 * StreamMapper Class
 * 
 * @package Twitchhls\Mapper
 */
class StreamMapper extends Mapper
{
    /**
     * Database
     * 
     * @Inject
     * @var EasyPDO 
     */
    protected $db;
    
    /**
     * TwitchAPI
     * 
     * @Inject
     * @var TwitchAPI 
     */
    protected $twitchApi;
    
    /**
     * StreamMapper constructor
     *
     * @Inject
     * @param EasyPDO $db
     * @param TwitchAPI $twitchApi
     */
    public function __construct(EasyPDO $db, TwitchAPI $twitchApi)
    {
        parent::__construct($db, $twitchApi);
    }

    /**
     * Method to get streams
     * 
     * @return array of Stream models
     */
    public function getStreams($gameId, $lang)
    {
        $this->twitchApi->setThumbSize(['width' => 320, 'height' => 180]);   
        $streams = $this->twitchApi->getActiveStreams($gameId, $lang);
        
        $result = [];
        
        /** @var Stream $streamModel */
        foreach ($streams as $stream) {
            $streamModel = new Stream();
            $streamModel->setUserId($stream['user_id']);
            $streamModel->setChannelName($stream['channel_name']);
            $streamModel->setThumbnailUrl($stream['thumbnail_url']);
            $streamModel->setAmountOfViewers($stream['viewer_count']);
            $result[] = $streamModel;
        }
        
        return $result;
    }
}

