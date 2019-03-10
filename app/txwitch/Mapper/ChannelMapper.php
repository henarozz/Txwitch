<?php
/**
 * Txwitch
 *
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Txwitch\Mapper;

use Txwitch\Component\EasyPDO;
use Txwitch\Component\TwitchAPI;
use Txwitch\Mapper\Mapper;
use Txwitch\Model\Channel;

/**
 * ChannelMapper Class
 *
 * @package Txwitch\Mapper
 */
class ChannelMapper extends Mapper
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
     * ChannelMapper constructor
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
     * Method to get channel by <channelName>
     *
     * @return Channel model
     */
    public function getChannel($channelName, $userId)
    {
        $playlist = $this->twitchApi->getChannelPlaylist($channelName);
        
        $channelModel = new Channel($channelName, $userId);
        $channelModel->setPlaylist($playlist);
        
        return $channelModel;
    }
    
    /**
     * Method to get all favorite channels
     *
     * @return array of favorite channels
     */
    public function getFavoriteChannels()
    {
        $sql = 'SELECT channel FROM favorites';
        $bind = [];
        
        $data = $this->db->fetchAssoc($sql, $bind);
        
        return $data;
    }
    
    /**
     * Method to add channel to favorites
     *
     * @param string $channelName
     * @param string $userId
     * @return array of data
     */
    public function addChannelToFavorites($channelName, $userId)
    {
        $favorite = [
            'channel' => $channelName,
            'user_id' => $userId
        ];
        
        try {
            $this->db->insert('favorites', $favorite);
            $data = ['data' => [
                'responseCode' => '1',
                'responseMessage' => 'Liked'
            ]];
        } catch (\PDOException $exception) {
            $data = ['data' => [
                'responseCode' => '0',
                'responseMessage' => 'Error'
            ]];
            /** @todo need to write exception to log */
        }
        
        return $data;
    }
    
    /**
     * Method to delete channel from favorites
     *
     * @param string $channelName
     * @return array of data
     */
    public function deleteChannelFromFavorites($channelName)
    {
        try {
            $this->db->delete('favorites', "channel=:user_channel", array(':user_channel' => $channelName));
            $data = ['data' => [
                'responseCode' => '1',
                'responseMessage' => 'Disliked'
            ]];
        } catch (\PDOException $exception) {
            $data = ['data' => [
                'responseCode' => '0',
                'responseMessage' => 'Error'
            ]];
            /** @todo need to write exception to log */
        }
        
        return $data;
    }
}
