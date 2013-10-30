<?php 

class tic{
	public function introduce($wechatObj, $postObj){
		$url = "http://1.bitoryst.sinaapp.com/";
		// public function retImgTex($Title, $ArticleCount, $Description, $PicUrl, $Url,$postObj){ // 测试成功 
        $wechatObj->retImgTex("腾讯创新俱乐部(duttic)", "1", "大连理工大学腾讯创新俱乐部是位于大连理工大学软件学院的一个技术社团...", $url."material/tic.bmp", $url."material/tic.html", $postObj);
	}
};

$t = new tic();


 ?>