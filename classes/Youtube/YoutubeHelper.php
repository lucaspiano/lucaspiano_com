<?php

require_once __DIR__ . "/YoutubeHelperParamException.php";
require_once __DIR__ . "/Video.php";
require_once __DIR__ . "/Comment.php";
require_once __DIR__ . "/Playlist.php";

class YoutubeHelper
{
    private $params;

    public function __construct(YoutubeParams $params)
    {
        $this->params = $params;
    }

    public function getPlaylists($maxResults = null)
	{
		$lang = $this->getCurrentLang();

		$params = [
			'part' => 'contentDetails,snippet',
			'channelId' => $this->params->getChannelId(),
			'key' => $this->params->getApiKey(),
		];

        $params['maxResults'] = 50;

		if (!is_null($maxResults)) {
			$params['maxResults'] = $maxResults;
        }

		$playlists = $this->getJson('playlists', $params);

		/** @var PlayList[] $collection */
		$collection = [];

		foreach ($playlists->items as $val) {
			if ($lang) {
				if (strpos($val->snippet->title, '[') !== false) {
					if (!(strpos($val->snippet->title, $lang) !== false)) {
						continue;
					}
				}
			}

			$collection[] = new PlayList(
                $val->id,
                $val->snippet->title,
                $val->contentDetails->itemCount,
                $val->snippet->thumbnails->high->url
            );
		}

		return $collection;
	}

	public function getPlayListById($playListId)
	{
		$params = [
			'part' => 'contentDetails,snippet',
			'id' => $playListId,
            'key' => $this->params->getApiKey(),
		];

		$playlists = $this->getJson('playlists', $params);
		$result = $playlists->items[0];

        return new PlayList(
            $result->id,
            $result->snippet->title,
            $result->contentDetails->itemCount,
            $result->snippet->thumbnails->high->url
        );
	}

    /**
     * @param $videoId
     * @return Video
     */
	public function getVideoDetails($videoId)
	{
		$params = [
			'part' => 'statistics',
			'id' => $videoId,
            'key' => $this->params->getApiKey(),
		];

		$videos = $this->getJson('videos', $params);
		$result = $videos->items[0];

		return new Video(
            $result->id,
            $result->statistics->viewCount,
            $result->statistics->viewCount,
            $this->getVideoComments($result->id)
        );
	}

    public function getVideoComments($videoId)
    {
        $params = [
            'part' => 'snippet,replies',
            'videoId' => $videoId,
            'key' => $this->params->getApiKey(),
        ];

        $comments = $this->getJson('commentThreads', $params)->items;
        $collection = [];

        foreach ($comments as $comment) {
            $collection[] = new Comment(
                $comment->id,
                $comment->snippet->topLevelComment->snippet->textDisplay,
                $comment->snippet->topLevelComment->snippet->authorDisplayName,
                $comment->snippet->topLevelComment->snippet->authorProfileImageUrl,
                $comment->snippet->topLevelComment->snippet->likeCount,
                $comment->snippet->topLevelComment->snippet->publishedAt
            );
        }


        return $collection;
	}

	private function getJson($method, $params)
	{
		$apiUrl = $this->params->getApiBaseUrl() . '/' . $method . '?' . http_build_query($params);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $apiUrl);
		$result = curl_exec($ch);
		curl_close($ch);

		return json_decode($result);
	}

	private function getCurrentLang()
	{
		$lang = $GLOBALS['LANG'];

		if ($lang) {
			$lang = '[' . strtoupper($lang) . ']';
		}

		return $lang;
	}
}