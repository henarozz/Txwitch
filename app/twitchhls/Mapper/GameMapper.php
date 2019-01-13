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
use Twitchhls\Model\Game;

/**
 * GamelMapper Class
 * 
 * @package Twitchhls\Mapper
 */
class GameMapper extends Mapper
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
     * GameMapper constructor
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
     * Method to get games
     * 
     * @return array of Game models
     */
    public function getGames()
    {
        $this->twitchApi->setThumbSize(['width' => 240, 'height' => 320]);
        $games = $this->twitchApi->getTopGames();
        
        $result = [];
        
        /** @var Game $gameModel */
        foreach ($games as $game) {
            $gameModel = new Game($game['id'], $game['name']);
            $gameModel->setBoxArtUrl($game['box_art_url']);
            $result[] = $gameModel;
        }
        
        return $result;
    }
}

