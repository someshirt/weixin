<?php include "weixinapi.php" ?>
<?php include "log.php" ?>
<?php include "searchMember.php" ?>
<?php include "userAction.php" ?>
<?php include "otherApi.php" ?>
<?php include "Articles.php" ?>
<?php include "record.php" ?>
<?php include "tic.php" ?>
<?php include "AI.php" ?>
<?php include "grabWebpage/pa.php" ?>
<?php

	// 过程逻辑
	// 逻辑部分设计
	$wechatObj = new weixinapi();

	$postObj = $wechatObj->getHttp();

	// 所有接口都会获得的信息
	$fromUsername = $postObj->FromUserName;  //发送方帐号（一个OpenID）
	$toUsername = $postObj->ToUserName;  //开发者微信号
	$keyword = trim($postObj->Content);  //消息内容
	$MsgType = $postObj->MsgType;
	
	$keyword = strtolower($keyword);
#记录用户的访问次数
	//记录用户访问次数        
	$r = new record();
	$r->re($fromUsername);
#反馈信息功能
	// 关于意见反馈：先提取上一条用户说了什么，然后把这一次说的加进去，然后分析上一次说的是不是“反馈”，如果是的话把这句话加进反馈表
	$lastCon = $r->readLast($fromUsername);
	$r->reNow($keyword ,$fromUsername);
	
	if(strpos($keyword, "反馈" )!==false || strpos($keyword, "意见" )!==false || strpos($keyword, "点评" )!==false){
    	$r->reCom($wechatObj, $postObj);
    }

	if (strpos($lastCon, "反馈" )!==false || strpos($lastCon, "意见" )!==false || strpos($lastCon, "点评" )!==false) {
		# code...
        $r = new record();
        $t = $r->comment($keyword, $fromUsername);
        $wechatObj->retText($t, $postObj);
	}


	// 以后所有的功能都只能加在这个功能后面，前面已经用户使用记录功能，千万不能动啊~~~~！！！！

#关于俱乐部的介绍功能
	if (strpos($keyword, "tic")!== false || strpos($keyword, "腾讯俱乐部") !== false|| strpos($keyword, "腾讯创新俱乐部") !== false) {
		# code...
		$tic = new tic();
		$tic->introduce($wechatObj ,$postObj);
	}
#查看总体功能
	if($keyword == "" || strpos($keyword ,"功能") !== false ){
		$t = "大家好，现在功能：
        /:@)智能聊天（面向所有用户）->可以英文单词翻译、可以看名词解释、可以查看天气、还可以随便说点什么，想要看什么直接用对话说就好
        /:v组内信息查询（面向组内用户）-> 输入vip（不是组里的不懂的/:v）类似语句就会有使用提示
        /:hug阅读tpai文章（面向所有用户）->输入”看文章“类似语句查看t派社区文章，列表内容会随tpai社区更新
        /:sun输入“tic”可以看俱乐部介绍
        /:ladybug输入学生周知查看最新10条学生周知
        /:gift输入“反馈”字样可以对本主页进行提意见";
        
        $wechatObj->retText($t, $postObj);
    }
#组员登录功能
	$logabout = new log();
	$fenge = explode(" ",$keyword);

	if($fenge[0] == "登陆"){
		$t = $logabout->dolog($fenge ,$fromUsername);
		$wechatObj->retText($t, $postObj);
	}
	
	if($keyword=="组员" || $keyword=="VIP" || $keyword == "vip" ){
		$t = "您好，对于组内的成员我们提供了内部功能，需要输入您的账号和密码)->初始账号密码都是您的学号
        /:rose忘记把信息给我的组员可以发邮箱：bitory@163.com申请啊/:rose";
        $wechatObj->retText($t, $postObj);
    }
#面向组员的查找功能

    if($logabout->isLog($fromUsername) == false && $logabout->isNotIn($keyword) == false){
    	// 如果没有登陆但是输入的名字是组员的名字
        $t = "这个人我好像认识，登陆了我就把他的秘密都告诉你/:X-)";
      	$wechatObj->retText($t, $postObj);
    }

/*
    if ($logabout->isLog($fromUsername)== true && $logabout->isNotIn($keyword) == false) {
    	# code...
    	$t = $search->searchone($keyword , $fromUsername); // 难道是这个有错？
        $wechatObj->retText($t, $postObj);
    }
*/
	if(strpos($keyword ,"查找") !== false || strpos($keyword ,"查询")!== false || strpos($keyword ,"查看")!== false ){
		if($logabout->isLog($fromUsername) ){
			// 进行绑定操作，也就是登录操作
			$t = "您好,您还没有进行登陆，请输入登陆+账号+密码 登陆账号（初始账号登录名和登录密码都是您的学号）享受内部消息查看功能
			例如: 登陆201191111,201191111 /:kiss 不要忘了中间的逗号啊
			不是组内成员的可以发邮箱：bitory@163.com 介绍自己得到邀请号哦
			";
			$wechatObj->retText($t, $postObj);
		}
        $search = new searchMember();
		if(strpos($keyword,"所有") !== false){
            $t = $search->searchall();
            $wechatObj->retText($t, $postObj);
		}
		else{
            $n = str_replace("查找","",$keyword);
            $n = str_replace("查询","",$n);
            $n = str_replace("查看","",$n);
			$t = $search->searchone($n , $fromUsername);
            $wechatObj->retText($t, $postObj);
		}
	}
	$userAction = new userAction();
#面向组员的修改密码功能
	if (strpos($keyword ,"改密码") !== false ) {
		# code...        
	    if($logabout->isLog($fromUsername) ){
			// 进行绑定操作，也就是登录操作
			$t = "您好,您还没有进行登陆，请输入log+账号+密码 登陆账号（初始账号登录名和登录密码都是您的学号）享受消息查看功能
			例如: log 201191111 201191111 /:kiss
			不是组内成员的可以发邮箱：bitory@163.com 要邀请号哦
			";
            
			$wechatObj->retText($t, $postObj);
		}
        
        $n = str_replace("改密码","",$keyword);
        //$wechatObj->retText($keyword, $postObj);
		$t = $userAction->updatePassword($n, $fromUsername);
		$wechatObj->retText($t, $postObj);
	}
#看学生周知功能
if(  strpos($keyword ,"学生周知") !== false ){
	$w = new webPage();
	$t = $w->getSsdut();
	$wechatObj->retText($t, $postObj);
}
#查看文章的功能
	if ( strpos($keyword ,"看文章") !== false || strpos($keyword ,"文章") !== false || strpos($keyword ,"阅读") !== false || strpos($keyword ,"tpai") !== false ||strpos($keyword ,"t派") !== false  ){
        $aaa = "<item>
                   <Title><![CDATA[%s]]></Title> 
                   <Description><![CDATA[%s]]></Description>
                   <PicUrl><![CDATA[%s]]></PicUrl>
                   <Url><![CDATA[%s]]></Url>
                   </item>
        ";
        
        $msgType = "news";
        $time = time($postObj);
        $ArticleCount = "5";
        $Title = "面试官最看重的是什么？";
        $Description = "虽然这是极个别的现象，但是我想通过这个真实的事情告诉大家，面试最重要的就是要把自己最好的一面展示给面试官。";
        $PicUrl = "http://tpai.qq.com/upload/public/common/images/2013/08/240_144_13153218233.jpg";
        $Url = "http://tpai.qq.com/article/view/127";
        $abc = new Articies();
        $abc->retImgTex($Title, $ArticleCount, $Description, $PicUrl, $Url,$postObj);
	}
#AI制作

	$AI = new AI();
	$t = $AI->getKey($keyword);
	if ($t != "asga46d45fgs45dg456d45gds546b54") {
		# code...
		$wechatObj->retText($t, $postObj);
	}
	$other = new otherApi();
	$t = $other->irobot($keyword); 
	$wechatObj->retText($t, $postObj);
?>