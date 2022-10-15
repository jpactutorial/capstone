<?php
class jpacObject{
	private $conn;
	public function __construct(){
  		try {
	 		$this->conn = new PDO("mysql:host=".db_server.";dbname=".db_name, db_user, db_pass);
  			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		} catch(PDOException $e) {
		  	echo "Connection failed: " . $e->getMessage();
		  	die;
		}
	}
	function CheckExists($table,$column,$value){
		$sth=$this->conn->prepare("SELECT * FROM ".$table." WHERE ".$column."='".$value."'");
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}
	function SQLQuery($sql) {
		$sth=$this->conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}
	function SQLResultParam($sql,$param) {
		$sth=$this->conn->prepare($sql);
		$i=1;
		foreach($param as $val){
			$sth->bindValue($i,$val);
			$i++;
		}
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	function SQLResult($sql,$param) {
		$sth=$this->conn->prepare($sql);
		$i=1;
		foreach($param as $val){
			$sth->bindValue($i,$val);
			$i++;
		}
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}
	function SQLPerformColumn($sql) {
		$sth=$this->conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	function SQLInsert($tbl,$data) {
		$sql="INSERT INTO ".$tbl." ";
		$param="";
		$paramVal="";
		foreach($data as $col=>$val){
			$param.="`".$col."` ,";
			$paramVal.="?,";
		}	
		$param=substr($param, 0,strlen($param)-1);
		$paramVal=substr($paramVal, 0,strlen($paramVal)-1);
		$q=$this->conn->prepare($sql."(".$param.") VALUES (".$paramVal.")");
		$i=1;
		foreach($data as $col=>$val){
			$q->bindValue($i,$val);
			$i++;
		}
		$q->execute();
		return $this->conn->lastInsertId();
	}
	function SQLUpdate($tbl,$data,$where) {
		$sql="UPDATE ".$tbl." SET ";
		$param="";
		foreach($data as $col=>$val){
			$param.="`".$col."`=? ,";
		}	
		$param=substr($param, 0,strlen($param)-1);
		$q=$this->conn->prepare($sql." ".$param." ".$where);
		$i=1;
		foreach($data as $col=>$val){
			$q->bindValue($i,$val);
			$i++;
		}
		$q->execute();
		return $q->rowCount();
	}
}
?>