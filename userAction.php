<?php
	
class userAction{
	public function updatePassword($massage, $userId){
		if (($massage) == "") {
			# 不满足输入信息
			$t = "您并没有输入密码，请输入“改密码 123456”的格式,并且密码中不能有空格，密码长度不能超过20个字符 ";
			return $t;
		}
        $newPass = $massage;
        if( strlen($newPass)< 7){
        	return "密码太短了，再改一次吧";
        }
        $mysql = new SaeMysql();
		$sql = "update massage set password = '$newPass' where phonestat = '$userId' ";
        $mysql->runSql($sql);
        return "密码修改成功";
	}

    
};	

?>