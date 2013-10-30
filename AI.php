<?php 
	
class AI{
	public function getKey($keyword){
		
		if($keyword == "于澎"){
			return "/:pig";
		}
		elseif ($keyword == "于彭") {
			# code...
			return "你想输入的是于澎吧，名字都没记住";
		}
		elseif ($keyword == "。。。") {
			# code...
			return "额，让你无语了";
		}
		elseif ($keyword == "赵乾利" || $keyword == "丽姐" || $keyword == "利姐") {
			# code...
			return "我们敬爱的利姐/:hug";
		}
		else{
			return "asga46d45fgs45dg456d45gds546b54";
		}
	}
}
 ?>