<?php 
class Database {
  private $host = "127.0.0.1";
	private $database_name = "atelier";
	private $username = "root";
	private $password = "root";
	public $conn;
	public function getConnection(){
	  $this->conn = null;
	  try{
		$this->conn = new PDO(
		"mysql:host=".$this->host.";dbname=".$this->database_name,
		$this->username, $this->password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$this->conn->exec("set names utf8");
	  }catch(PDOException $exception){
		echo "Database could not be connected: " . $exception->getMessage();
	  }
		return $this->conn;
	  }
}  
?>
