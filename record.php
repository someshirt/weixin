<?php

class record{
    
    public function re($user){
        // 将用户的访问次数记录下来
    	$mysql = new SaeMysql();
        $sql = "select num from record where user = '$user'";
        $data = $mysql->getData( $sql );
        
        if( empty($data) == false){
            $i = intval($data[0]['num']);
            $i = $i + 1;
            $sql = "update record set num = '$i' where user = '$user'";
            $mysql->runSql( $sql ); 
        }
        
        else{
        	$sql = "insert into record (user, num)values('$user', '1')";
            $mysql->runSql( $sql ); 
        }
        
    }

    public function comment($comment, $user){
        // 将用户的评论提交
        $mysql = new SaeMysql();
        $sql = "select comment from commment where user = '$user'";
        $data = $mysql->getData( $sql );
        if( empty($data)){
            $sql = "insert into comment (user, comment)values('$user', '$comment') ";
            $mysql->runSql( $sql ); 
        }
        else{
        	$sql = "update commment set comment = '$comment' where user = '$user' ";
            $mysql->runSql($sql);
        }
        return "感谢你的反馈，我们会认真对您的意见";
    }
    
    public function reNow($keyword, $userId){
        // 记录用户本次的输入
        $mysql = new SaeMysql();
        $sql = "update record set lastOperation = '$keyword' where user = '$userId' ";
        $mysql->runSql($sql);
    }

    public function readLast($userId){
        // 读取用户上一次输入了什么
        $mysql = new SaeMysql();
        $sql = "select lastOperation from record where user = '$userId' ";
        $data = $mysql->getData($sql);
        return $data[0]['lastOperation'];
    }
    
    public function reCom($wechatObj, $postObj){
    	$wechatObj->retText("请直接输入您的反馈信息，我们会既相互您的反馈信息", $postObj);
    }


};	

?>