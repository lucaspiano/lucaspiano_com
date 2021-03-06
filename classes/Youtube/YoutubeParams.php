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

    /**
     * @var array
     */
    private $clientSecret;

    public function __construct($apiKey, $apiBaseUrl, $channelId, $clientSecret)
    {
        if (!$apiKey) {
            throw new YoutubeHelperParamException('apiKey');
        }

        if (!$apiBaseUrl) {
            throw new YoutubeHelperParamException('apiBaseUrl');
        }

        if (!$channelId) {
            throw new YoutubeHelperParamException('channelId');
        }

        if (!$clientSecret) {
            throw new YoutubeHelperParamException('clientSecret');
        }

        $this->apiKey = $apiKey;
        $this->apiBaseUrl = $apiBaseUrl;
        $this->channelId = $channelId;
        $this->clientSecret = $clientSecret;
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

    /**
     * @return array
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }
}