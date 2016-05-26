<?php
//将传入的参数整合到$params中
$params=$_GET;
$params+=$_POST;
//如果action为空，则输出控制页面
if(!isset($params['action'])){
	echo file_get_contents("window.html");
	return;
}
//配置参数
elseif($params['action']=='config'){
	header("content-type:text/html;charset=utf-8");
	$configFilePath="json/config.json";
	$json=file_get_contents($configFilePath);
	$config=json_decode($json,TRUE);
	
	if(isset($params["describe"])){
		$config['describe']=$params["describe"];
	}
	if(isset($params["host"])){
		$config['mysql']['host']=$params["host"];
	}
	if(isset($params["username"])){
		$config['mysql']['username']=$params["username"];
	}
	if(isset($params["password"])){
		$config['mysql']['password']=$params["password"];
	}
	if(isset($params["database"])){
		$config['mysql']['database']=$params["database"];
	}
	$json=json_encode($config,JSON_PRETTY_PRINT);
	file_put_contents($configFilePath, $json);
	
	$json=file_get_contents($configFilePath);
	echo $json;
}
//检查model对应的数据表是否都创建了并且可以正常连接
//开始创建新添加的model对应的数据表
elseif($params['action']=="check"){
	
}
//增删改查 model
elseif($params['action']=="addModel"){
	
}
elseif($params['action']=="addModel"){
	
}
elseif($params['action']=="addModel"){
	
}
elseif($params['action']=="addModel"){
	
}
//增删改查 model中的column
elseif($params['action']=="addColumn"){
	
}
elseif($params['action']=="addColumn"){
	
}
elseif($params['action']=="addColumn"){
	
}
elseif($params['action']=="addColumn"){
	
}
?>
