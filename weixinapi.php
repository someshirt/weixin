<?php
class weixinapi
{
    // 获得 $postObj
    public function getHttp(){  // 测试成功
    	  $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $t =  strlen($postObj->MsgType) ;
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        return $postObj;
    }
    
    // 发送文本信息
    public function retText($t, $postObj){  // 测试成功
    	  $msgType =  "text";
        $time = time($postObj);
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";
        // 返回文本信息模式
        $resultStr = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, $time, $msgType, $t);
        //echo $resultStr;
        echo $resultStr;
    }  

    // 发送图文信息
    public function retImgTex($Title, $ArticleCount, $Description, $PicUrl, $Url,$postObj){ // 测试成功 
        $imgtextTpl = "
                   <xml>
                   <ToUserName><![CDATA[%s]]></ToUserName>
                   <FromUserName><![CDATA[%s]]></FromUserName>
                   <CreateTime>%s</CreateTime>
                   <MsgType><![CDATA[%s]]></MsgType>
                   <ArticleCount>%s</ArticleCount>
                   <Articles>
                   <item>
                   <Title><![CDATA[%s]]></Title> 
                   <Description><![CDATA[%s]]></Description>
                   <PicUrl><![CDATA[%s]]></PicUrl>
                   <Url><![CDATA[%s]]></Url>
                   </item>
                   </Articles>
                   </xml> 
                   ";    
        // 返回图文消息模式
        $msgType = "news";
        $time = time($postObj);
        $resultStr = sprintf($imgtextTpl, $postObj->FromUserName, $postObj->ToUserName, $time, $msgType, $ArticleCount,$Title,$Description,$PicUrl,$Url);
        
        echo $resultStr;
    }
    
    // 返回音乐消息
    public function retMusic($Title, $Description, $musicUrl, $bettermusic, $postObj){
    	$imgmusicTpl = "
                   <xml>
				   <ToUserName><![CDATA[%s]]></ToUserName>
				   <FromUserName><![CDATA[%s]]></FromUserName>
				   <CreateTime>%s</CreateTime>
				   <MsgType><![CDATA[%s]]></MsgType>
				   <Music>
				   <Title><![CDATA[%s]]></Title>
				   <Description><![CDATA[%s]]></Description>
				   <MusicUrl><![CDATA[%s]]></MusicUrl>
				   <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
				   </Music>
				   </xml>
                   ";    
        // 返回音乐消息模式
        $msgType = "music";
        $time = time($postObj);
		$resultStr = sprintf($imgmusicTpl, $postObj->FromUserName, $postObj->ToUserName, $time, $msgType, $Title, $Description, $musicUrl, $bettermusic);      
        echo $resultStr;
    }
    
     // 返回语音消息
    public function retVoice($id, $postObj){
    	$imgmusicTpl = "
                   <xml>
				   <ToUserName><![CDATA[%s]]></ToUserName>
				   <FromUserName><![CDATA[%s]]></FromUserName>
				   <CreateTime>%s</CreateTime>
				   <MsgType><![CDATA[%s]]></MsgType>
				   <Voice>
				   <MediaId><![CDATA[%s]]></MediaId>
				   </Voice>
                   <FuncFlag>0</FuncFlag>
				   </xml>
                   ";    
        // 返回语音消息模式
        $msgType = "voice";
        $time = time($postObj);
        $s = $id;
		$resultStr = sprintf($imgmusicTpl, $postObj->FromUserName, $postObj->ToUserName, $time, $msgType, $s );      
        echo $resultStr;
    }
    
};

?>