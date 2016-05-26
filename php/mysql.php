<?php
//header("Content-type: text/html; charset=utf-8"); //输出内容之前，说明编码类型

//进行数据库操作的类，操作方法
//$db=new GDMySQL("127.0.0.1","root","123456","test");//新建对象
//$db->connect();//连接数据库
//print_r($db->search("table1", "name='张三' or age=231"));//中间进行操作
//$db->close();//关闭数据库连接

class GDMySQL{
	var $server;//数据库所在的服务器
	var $username;//用户名
	var $password;//密码
	var $database;//数据库名
	
	var $connect;//与数据库的连接
	//构造函数
	function __construct($server,$username,$password,$database){
		$this->server=$server;
		$this->username=$username;
		$this->password=$password;
		$this->database=$database;
	}
	//连接
	function connect(){
		if($this->connect){
			$this->close();
		}
		$this->connect=mysql_connect($this->server,$this->username,$this->password);
		if(!$this->connect){
			die("Error:".mysql_error());
		}
	}
	//关闭连接
	function close(){
		if($this->connect){
			mysql_close($this->connect);
		}
	}
	//执行任意的sql语句
	function query($query){
		$result=mysql_db_query($this->database,$query,$this->connect);
		if(!$result){
			die("Error:".mysql_error());
		}
		else{
			return $result;
		}
	}
	//解析返回的结果
	function fetch($result){
		mysql_data_seek($result, 0);
		$table=array();
		while($row=mysql_fetch_array($result)){
			$table[]=$row;
		}
		return $table;
	}
	//按条件搜索，返回值是一个二维数组
	//$database->search("tablename", "name='张三' or age=231");
	function search($table,$require){
		$sqlString="select * from $table";
		if($require!=null){
			$sqlString.=" where ".$require;
		}
		echo $sqlString."<br/>";
		$result=$this->query($sqlString);
		return $this->fetch($result);
	}
	//插入新的数据，$array为传递参数用的关联数组
	//$database->insert("tablename", array("name"=>"张三","age"=>23));
	function insert($table,$array){
		$sqlString="insert into $table(";
		$str="value(";
		$i=0;
		foreach($array as $key=>$value){
			$sqlString.=$key;
			if(is_string($value)){
				$str.="'".$value."'";
			}
			else{
				$str.=$value;
			}
			if($i!=count($array)-1){
				$sqlString.=",";
				$str.=",";
			}
			else{
				$sqlString.=") ";
				$str.=") ";
			}
			$i++;
		}
		$sqlString.=$str;
		return $this->query($sqlString);
	}
}

?>