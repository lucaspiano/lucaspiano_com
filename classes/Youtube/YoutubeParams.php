<?php

final class YoutubeParams
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $apiBaseUrl;

    /**
     * @var string
     */
    private $channelId;

    public function __construct($apiKey, $apiBaseUrl, $channelId)
    {
        if (!$apiKey) {
            throw new YoutubeHelperParamException($apiKey);
        }

        if (!$apiBaseUrl) {
            throw new YoutubeHelperParamException($apiBaseUrl);
        }

        if (!$channelId) {
            throw new YoutubeHelperParamException($channelId);
        }

        $this->apiKey = $apiKey;
        $this->apiBaseUrl = $apiBaseUrl;
        $this->channelId = $channelId;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getApiBaseUrl()
    {
        return $this->apiBaseUrl;
    }

    /**
     * @return string
     */
    public function getChannelId()
    {
        return $this->channelId;
    }
}