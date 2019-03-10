<?php
/**
 * Txwitch
 *
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Txwitch\Component;

/**
 * TwitchAPI Client Class
 *
 * @package Txwitch\Component
 */
class TwitchAPI
{
    
    /**
     *
     * @var string
     */
    private $clientId;
    
    /**
     *
     * @var GuzzleHttp\Client
     */
    private $httpClient;
    
    /**
     *
     * @var string
     */
    protected $usherUrl;
    
    /**
     *
     * @var string
     */
    protected $tokenUrl;
    
    /**
     *
     * @var string
     */
    protected $gameUrl;
    
    /**
     *
     * @var string
     */
    protected $streamUrl;
    
    /**
     *
     * @var array
     */
    protected $thumbSize;

    /**
     * TwitchAPI constructor
     *
     * @param array $settings
     * @param GuzzleHttp\Client $httpClient
     */
    public function __construct($settings, $httpClient)
    {
        $this->clientId = $settings['clientId'];
        $this->httpClient = $httpClient;
        $this->usherUrl = $settings['usherUrl'];
        $this->tokenUrl = str_replace('{clientId}', $this->clientId, $settings['tokenUrl']);
        $this->gameUrl = $settings['gameUrl'];
        $this->streamUrl = $settings['streamUrl'];
        $this->thumbSize = $settings['thumbSize'];
    }
    
    /**
     * Method to get thumb size (width, height)
     *
     * @return array
     */
    public function getThumbSize()
    {
        return $this->thumbSize;
    }
    
    /**
     * Method to set thumb size (width, height)
     *
     * @param array $thumbSize
     */
    public function setThumbSize(array $thumbSize = [])
    {
        $this->thumbSize = $thumbSize;
    }
    
    /**
     * Method to get twitch top games (limit 100 from gameUrl)
     *
     * @return array
     */
    public function getTopGames()
    {
        $requestUrl = $this->gameUrl;
        
        $response = $this->httpClient->request('GET', $requestUrl, ['headers' => ['Client-ID' => $this->clientId]]);
        $responseBody = $response->getBody();
        $responseData = $responseBody->getContents();
        $responseData = json_decode($responseData, true);
        
        foreach ($responseData['data'] as $key => $game) {
            $boxArtUrl = $game['box_art_url'];
            $boxArtUrl = str_replace('{width}', $this->thumbSize['width'], $boxArtUrl);
            $boxArtUrl = str_replace('{height}', $this->thumbSize['height'], $boxArtUrl);
            $responseData['data'][$key]['box_art_url'] = $boxArtUrl;
        }

        return $responseData['data'];
    }
    
    /**
     * Method-helper to get channel name from thumbnail url
     *
     * @param string $thumbnailUrl
     * @return string
     */
    private function getChannelName($thumbnailUrl)
    {
        if (empty($thumbnailUrl)) {
            return null;
        }
        
        $channelName = explode('live_user_', $thumbnailUrl);
        $channelName = explode('-{width', $channelName[1]);
        
        return $channelName[0];
    }
    
    /**
     * Method to get active streams
     *
     * @param string $gameId
     * @param string $lang
     * @return array
     */
    public function getActiveStreams($gameId = '', $lang = '')
    {
        $queryUrl = '';
        $queryUrl.= !empty($gameId) ? '&game_id=' . $gameId : '';
        $queryUrl.= !empty($lang) ? '&language=' . $lang : '';
        
        $requestUrl = $this->streamUrl . $queryUrl;
        
        $response = $this->httpClient->request('GET', $requestUrl, ['headers' => ['Client-ID' => $this->clientId]]);
        $responseBody = $response->getBody();
        $responseData = $responseBody->getContents();
        $responseData = json_decode($responseData, true);
        
        foreach ($responseData['data'] as $key => $stream) {
            $thumbnailUrl = $stream['thumbnail_url'];
            $channelName = $this->getChannelName($thumbnailUrl);
            $responseData['data'][$key]['channel_name'] = $channelName;
            $thumbnailUrl = str_replace('{width}', $this->thumbSize['width'], $thumbnailUrl);
            $thumbnailUrl = str_replace('{height}', $this->thumbSize['height'], $thumbnailUrl);
            $responseData['data'][$key]['thumbnail_url'] = $thumbnailUrl;
        }
        
        return $responseData['data'];
    }
    
    /**
     * Method-helper to get API token and signature
     *
     * @param string $channelName
     * @return array
     */
    private function getChannelTokenAndSignature($channelName)
    {
        $requestUrl = str_replace('{user_channel}', $channelName, $this->tokenUrl);
        
        $response = $this->httpClient->request('GET', $requestUrl, ['headers' => ['Client-ID' => $this->clientId]]);
        $responseBody = $response->getBody();
        $responseData = $responseBody->getContents();
        $responseData = json_decode($responseData, true);
        
        return $responseData;
    }
    
    /**
     * Method to get playlist of channel
     *
     * @param type $channelName
     * @return array
     */
    public function getChannelPlaylist($channelName)
    {
        $tokenAndSignature = $this->getChannelTokenAndSignature($channelName);
        
        $usherUrl = $this->usherUrl;
        $random = rand(0, 1E7);
        
        $requestUrl = str_replace('{user_channel}', $channelName, $usherUrl);
        $requestUrl = str_replace('{token}', $tokenAndSignature['token'], $requestUrl);
        $requestUrl = str_replace('{sig}', $tokenAndSignature['sig'], $requestUrl);
        $requestUrl = str_replace('{random}', $random, $requestUrl);
        
        $response = $this->httpClient->request('GET', $requestUrl, ['headers' => ['Client-ID' => $this->clientId]]);
        $responseBody = $response->getBody();
        $responseData = $responseBody->getContents();
        $responseData = explode("\n", $responseData);
        
        $playlist = [];
        $i = 0;
        
        /** @todo need to refactoring EXTM3U parse algorithm using github/chrisyue/php-m3u8 */
        foreach ($responseData as $row) {
            if (substr_count($row, '#EXT-X-STREAM-INF:') > 0) {
                $row = str_replace('#EXT-X-STREAM-INF:', '', $row);
                $rowArray = explode(',', $row);
                $playlist[$i]['inf'] = $rowArray;
            }
            if (substr_count($row, 'http') > 0) {
                $playlist[$i]['uri'] = $row;
                $i++;
            }
        }
        
        return $playlist;
    }
}
