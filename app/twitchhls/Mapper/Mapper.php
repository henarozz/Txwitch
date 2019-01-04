<?php
/**
 * TwitchHLS
 * 
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Twitchhls\Mapper;

use Twitchhls\Component\EasyPDO;
use Twitchhls\Component\TwitchAPI;

/**
 * Abstract Mapper Class
 * 
 * @package Twitchhls\Mapper
 */
abstract class Mapper {
    /**
     * DI Container
     * 
     * @Inject
     * @var EasyPDO 
     */
    protected $db;
    
    /**
     * DI Container
     * 
     * @Inject
     * @var TwitchAPI 
     */
    protected $twitchApi;
    
    /**
     * Mapper constructor
     * 
     * @param EasyPDO $db
     * @param TwitchAPI $twitchApi
     */
    public function __construct(EasyPDO $db, TwitchAPI $twitchApi)
    {
        $this->db = $db;
        $this->twitchApi = $twitchApi;
    }
}
