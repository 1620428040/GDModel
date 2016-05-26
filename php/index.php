<?php
if($_GET["action"]=="init"){
	init();
}
//$fp=fopen("model.json", "a+");
//$content=fread($fp, 0);
//fclose($fp);
header("Content-type: text/html; charset=utf-8"); //输出内容之前，说明编码类型
$model=json_decode(file_get_contents("model.json"),TRUE);
require("mysql.php");

//根据现存的模型文件检测数据库，如果（数据库，数据表，字段）不存在则创建
function init(){
	
}
//检测模型文件是否存在
function isExist(){
	if(file_exists("model.json")){
		return TRUE;
	}
	else{
		return FALSE;
	}
}
//创建模型文件
function create(){
	if(isExist()){
		return "模型已存在";
	}
}
//删除模型文件
function delete(){
	
}
?>