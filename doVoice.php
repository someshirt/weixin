<?php
class doVoice{
    // 测试成功函数
    // 保存语音
    public function savaVoice($user, $id, $wechatObj, $postObj){
    	$mysql = new SaeMysql();
        // 获得这个用户存了多少语音
        $sql = "SELECT * FROM user WHERE name = '$user'";
        $dat = $mysql->getData( $sql );
        if($dat == NULL){
        	$sql = "INSERT INTO user (name, num)VALUES('$user', '0')";
			$mysql->runSql( $sql ); 
        }
        $data = $dat[0]['num'] + 1;    
        // 增加数据库元祖
        $sql = "INSERT INTO voice (id, user, numListened, numLike, numDel, numUser)VALUES( '$id', '$user', '0', '0' ,'0','$data')";
        $mysql->runSql( $sql );       
        $t = "语音已存储";
        // 存储后改变数据库中user的值
        $sql  = "UPDATE user set num = '$data' where name = '$user'";
        $mysql->runSql( $sql );   
        // echo "";
        $wechatObj->retText($t, $postObj);
    }
    
    // 赞功能
    public function zan($user, $wechatObj, $postObj){
        $mysql = new SaeMysql();
        $sql = "SELECT * FROM user WHERE name = '$user'";
        $dat = $mysql->getData( $sql );
        $id = $dat[0]['previous'];
        //$wechatObj->retText("ad", $postObj);
        
        $sql = "SELECT * FROM zan WHERE user = '$user' and voice = '$id'";
        $data = $mysql->getData( $sql );
        $t = "begin";
        if($data != NULL){
        	$t = "对不起,您已经赞过一次了，不能再赞这个语音了";
        }
        else{
            $time = date('Y-m-d H:i:s');
        	$sql = "INSERT INTO zan (user,voice,date)VALUES('$user', '$id','$time')";
            $mysql->runSql( $sql );       
            $t = "赞成功了";
        }
        $wechatObj->retText($t, $postObj);
        //$wechatObj->retText($t, $postObj);
        
    }  
};

?>