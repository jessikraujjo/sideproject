<?php
/**
* 
*/
class Video 
{
	public $image;
	public $link;
	
	function __construct($image, $link)
	{
		$this->image = $image;
		$this->link = $link;
	}
}

/**
* 
*/
class Canal

{
	const API_VIDEOS = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyB-x02jdC6lUkukDytptFw6xP6WG1_XOiY&part=id&channelId=UCTJ1mLre8sT-d4KuvmQsSQA&publishedAfter=2016-11-21T00:00:00Z&maxResults=50';
    const API_VIDEO_IMAGE= "https://www.googleapis.com/youtube/v3/videos?key=AIzaSyB-x02jdC6lUkukDytptFw6xP6WG1_XOiY&part=snippet";
	
	private static function getIdVideosFromAPI(){
		$url = self::API_VIDEOS;
		$json = file_get_contents($url);
		$data = json_decode($json);
		return array_map(function($item){return $item->id->videoId;}, $data->items);
		/*$arr = array();
		foreach ($data->items as $item) {
			array_push($arr, $item->id->videoId);
		}
		return $arr;*/
	}

	private static function getImageFromAPI($videoId){
		$url = self::API_VIDEO_IMAGE . "&id=$videoId";
		$json = file_get_contents($url);
		$data = json_decode($json);
		return $data->items[0]->snippet->thumbnails->medium->url;
	}

	public static function getVideo(){
		$idVideosAPI = self::getIdVideosFromAPI();
		$videoDesafio = 100;
		$videosFaltam = $videoDesafio - count($idVideosAPI);
		
		$videos = array();

		for ($i=1; $i <= $videosFaltam; $i++) { 
			$semVideo = new Video("https://placeholdit.imgix.net/~text?txtsize=33&txt=&w=320&h=180", "#");
			array_push($videos, $semVideo);
		}

		foreach ($idVideosAPI as $umVideoId) {
			$image = self::getImageFromAPI($umVideoId);
			$link = "https://www.youtube.com/watch?v=" . $umVideoId;
			$video = new Video($image, $link);

			array_push($videos, $video);
		}
		return $videos;
		//return self::getImageFromAPI("test");
		/*$video1 = new Video("image1", "link1");
		$video2 = new Video("image2", "link2");
		$video3 = new Video("image3", "link3");

		return array($video1, $video2, $video3);*/
	}


}


?>