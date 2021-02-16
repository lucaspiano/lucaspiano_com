<?php

class YoutubeHelper{

	//Static vars
	static $API_KEY = 'AIzaSyBLtsBUJ6Sy6pzGEKeVjUH4KVgAwBRHB6c';

	static $CHANNEL_ID = 'UCR2dv_znZ_o5GO8tUMGZZUg';

	static $API_BASE = 'https://www.googleapis.com/youtube/v3/';

	/* *******************************
	 * Public Methods
	 * *******************************/

	public function GetPlaylists($maxResults = null){

		$lang = $this->GetCurrentLang();

		$params = array(
		            'part' => 'contentDetails,snippet',
		            'channelId' => self::$CHANNEL_ID,
		            'key' => self::$API_KEY,
			        );

		if (is_null($maxResults))
		 	$params['maxResults'] = 50;
		 else
		 	$params['maxResults'] = $maxResults;

		$playlists = $this->GetJson('playlists', $params);

		$model = array();

	     foreach($playlists->items as $val) {
			
			if ($lang) {

				if (strpos($val->snippet->title, '[') !== false){

					if (!(strpos($val->snippet->title, $lang) !== false)){
						continue;
					}
				}
			}
			$item = new PlayList();
			$item->Id = $val->id;
			$item->Title = $val->snippet->title;
			$item->Total = $val->contentDetails->itemCount;
			$item->Thumbnail = $val->snippet->thumbnails->high->url;

    		array_push($model, $item);
		}
		

		return $model;
	}

	public function GetPlayListById($playListId){

		$params = array(
		            'part' => 'contentDetails,snippet',
		            'id' => $playListId,
		            'key' => self::$API_KEY,
			        );

		$playlists = $this->GetJson('playlists', $params);

		$result = $playlists->items[0];

		$model = new PlayList();
		$model->Id = $result->id;
		$model->Title = $result->snippet->title;
		$model->Total = $result->contentDetails->itemCount;
		$model->Thumbnail = $result->snippet->thumbnails->high->url;

		return $model;


	}

	public function GetVideoDetails($videoId){

		$params = array(
		            'part' => 'statistics',
		            'id' => $videoId,
		            'key' => self::$API_KEY,
			        );

		$videos = $this->GetJson('videos', $params);

		$result = $videos->items[0];

		$model = new Video();
		$model->Id = $result->id;
		$model->ViewCountInt = $result->statistics->viewCount;
		$model->ViewCount = number_format(intval($result->statistics->viewCount),0,",",".");

		return $model;
	}

	public function ChannelId(){
		return self::$CHANNEL_ID;
	}


	/* *******************************
	 * Private Methods
	 * *******************************/

	private function GetJson($method,$params){

		$api_url = self::$API_BASE . $method . '?' . http_build_query($params);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $api_url);
		$result = curl_exec($ch);
		curl_close($ch);

		return json_decode($result);
	}

	private function GetCurrentLang(){
		$lang = $GLOBALS['LANG'];
		if ($lang)
			$lang = '[' . strtoupper($lang) . ']';

		return $lang;
	}


	/*
	$api_url = "https://www.googleapis.com/youtube/v3/playlists?part=snippet&channelId=UCR2dv_znZ_o5GO8tUMGZZUg&key=AIzaSyDVnbmSW3Z4I0YuFCSR0eN_kc2RzHBadv4";
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $api_url);
	$result = curl_exec($ch);
	curl_close($ch);

	$playlists = json_decode($result);

	echo $playlists->kind;
	*/
		

}


/* *******************************
	 * Models
	 * *******************************/

class PlayList {
	public $Id;
	public $Title;
	public $Total;
	public $Thumbnail;
}

class Video {
	public $Id;
	public $ViewCount;
	public $ViewCountInt;
}


?>
