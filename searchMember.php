<?php

class searchMember{
    public function searchall(){
        $mysql = new SaeMysql();
        $sql = "select count(*) as c from massage";
        $data = $mysql->getData( $sql );
        $num = $data[0]['c'];
        $sql = "select name from massage ";
        $data = $mysql->getData( $sql );
        $t = "";
        for($i=0;$i < $num ;$i++){
           $t.=$i.".".$data[$i]['name']." ";
        }
        return $t."   以上结果顺序按照注册时候的班级号排出";
    }

    public function searchone($name, $userId){
        $mysql = new SaeMysql();
        $sql = "select * from massage where name = '$name' ";
        $data = $mysql->getData( $sql );

        if(empty($data) ){
            
            $sql = "select count(*) as c from massage ";
            $data = $mysql->getData( $sql );
            $y = intval($data[0]['c']);
            
            if( is_numeric($name)==false || intval($name) >= $y ){
              return  "没有这个人";
            }
        }
        
        if(is_numeric($name)){
        	$sql = "select * from massage";
            $data = $mysql->getData( $sql );
            $n = intval($name);
            $num = $data[$n]['searchedNum'];
            $num = $num + 1;
        }else{
            $sql = "select * from massage where name = '$name'";
            $data = $mysql->getData( $sql );
            $num = $data[0]['searchedNum'];
            $num = $num + 1;
            $n = 0;
        }
        if($data[$n]['phonestat'] == $userId){
            $t = "由于这个是查你自己的信息，所以多给你显示几条吧".
            "
            姓名：".$data[$n]['name'].
            "
            性别：".$data[$n]['sex'].
            "
            班级：".$data[$n]['class'].
            "
            电话号：".$data[$n]['phone'].
            "
            偶像：".$data[$n]['wanted'].
            "
            自我描述：".$data[$n]['tell'].
            "
            被他人查找的次数：".$data[$n]['searchedNum'].
            "
            个人密码：".$data[$n]['password'];
            return $t;
        }
        else{
            $sql = "update massage set searchedNum = '$num' where name = '$name '";
            $mysql->runSql( $sql ); 
            return "以下是这个人的信息：
            "."
            姓名：".$data[$n]['name'].
            "
            性别：".$data[$n]['sex'].
            "
            班级：".$data[$n]['class'].
            "
            电话号：".$data[$n]['phone']
            ;
        }
    }
}


$a = new searchMember();
echo $a->searchone("asd");
echo "!!!!!!!!!!asd";

?>