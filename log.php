<?php

class log{
	public function isLog($user ){
		$mysql = new SaeMysql();
		$sql = "select phonestat from massage where phonestat = '$user'";
		$data = $mysql->getData( $sql );
		// 如果这个手机没有绑定，那么返回 true
		return empty($data); 
	}

	public function dolog($massage, $fromuserid){
		// 进行登录操作，根据登陆内容直接返回对应的信息
		// 首先判断是否符合输入规范
		if(count($massage) != 3){
			$t = "对不起，您的密码和账号信息输入格式错误";
			return $t;
		}
		$user = $massage[1];
		$password = $massage[2];

		$mysql = new SaeMysql();
		$sql = "select name from massage where id = '$user' and  password = '$password' ";
		$data = $mysql->getData( $sql );
		if( empty($data) ){
			$t = "对不起，您的密码和账号信息输入内容错误";
			return $t;
		}
		// 数据库中插入信息
		$sql = "update massage set phonestat = '$fromuserid' where id = '$user'";
		$mysql->runSql( $sql );
		$name = $data[0]['name'];
		$t = $name."您好，欢迎您的登陆。现在的内部功能：查看现在组员信息（姓名+电话号码）
		输入”查看所有“类似的词语 查看组员名单
		输入”查看+名字 查看对应组员信息“";
		return $t;
	}

	public function isNotIn($name){
		// 看这个人的名字是不是组内成员
		$mysql = new SaeMysql();
		$sql = "select id from massage where name = '$name'";
		$data = $mysql->getData( $sql );
		return empty($data);
	}
    
};
$a = new log();
if($a->isNotIn("于澎")==false ){
	echo "ok";
}
else{
	echo "asdfsdf";
}

?>