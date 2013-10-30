<?php 
	
class otherApi{
	public function irobot($chat){
		urlencode($chat);
		$url = "http://lan.wddcn.com/weixin/talk.ashx?chat=".$chat;
		$t = file_get_contents($url, "r");
		return $t;
	}

	public function weather($location){
        //urlencode($location);
		$url = "http://api.map.baidu.com/telematics/v3/weather?location=$location&ak=A9a1b697344755bcc2f08960a2ea4abe";
		$t = file_get_contents($url, "r");
        $postObj = simplexml_load_string($t, 'SimpleXMLElement', LIBXML_NOCDATA);
        
		return $postObj->results->currentCity;
	}

    public function getMusic(){
        $url = "http://mp3.baidu.com/dev/api/?tn=getinfo&ct=0&ie=utf-8&word="+$name+"&format=json"; 
        $mode = "#\"song_id\":\"([\d]*)\"#i";
        #echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
        $arr = array();
        while(empty($arr){
        	$content=file_get_contents($url);
        	preg_match_all($mode,$content,$arr);
        }


        $url = "http://ting.baidu.com/data/music/links?songIds="+$songID[0];
        $content=file_get_contents($url);
        $mode = "#\"songLink\":\"(.*)\"#i";
        preg_match_all($mode,$content,$arr);

        $arr[0] = $arr[0].replace("\\","")
        $result = explode('"|,',songID[0])[0]
        return $result;
    }

};

$t = new otherApi();
echo $t->weather("大连");
echo "asd";

 ?>