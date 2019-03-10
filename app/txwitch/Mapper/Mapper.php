<?php
/**
 * Txwitch
 *
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Txwitch\Mapper;

use Txwitch\Component\EasyPDO;
use Txwitch\Component\TwitchAPI;

/**
 * Abstract Mapper Class
 *
 * @package Txwitch\Mapper
 */
abstract class Mapper
{
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
