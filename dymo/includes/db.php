<?php

/*
class Database {

	private $db;

	private $DBH;

    public function __construct() {
    	$db['db_host'] = "localhost";
		$db['db_user'] = "root";
		$db['db_pass'] = "";
		$db['db_name'] = "dymo";
        
        $this->DBH = new MySQli(
					        	$this->db['db_host'],
					        	$this->db['db_user'],
					        	$this->db['db_pass'],
					        	$this->db['db_name'] 
        			);

    }
    /*
    public function doSOmething() {
        $this->DBH->foo();
    }
    */
/*
    public function getDB(){
    	return $this->DBH;
    }
}
*/


class Database {
/*
	const DB_HOST = '';
	const DB_USER = '';
	const DB_PASS = '';
	const DB_NAME = '';
*/
	private $db;
	private $mysqli;
	

    public function __construct() {
    	$this->db['db_host'] = "localhost";
		$this->db['db_user'] = "u221062269_fer";
		$this->db['db_pass'] = "A1b2c/3d4e5";
		$this->db['db_name'] = "u221062269_dymo";
        

		

		/*
		$query = "SET NAMES utf8";
		mysqli_query($mysqli,$query);
		*/
    }

    /*
    public function doSOmething() {
        $this->DBH->foo();
    }
    */

    public function getDB(){
    	/* Crear el objeto de la conexión */
		$this->mysqli = new mysqli($this->db['db_host'] , $this->db['db_user'], $this->db['db_pass'], $this->db['db_name']);


		/* Checar la conexión */
		if ($this->mysqli->connect_error) {

		    die("Connection to database failed: #" . $this->mysqli->connect_errno . " - " . $this->mysqli->connect_error);
		}

		/* change character set to utf8 */
		if (!$this->mysqli->set_charset("utf8")) {
		  	printf("Error loading character set utf8: %s\n", $this->mysqli->error);
		} else {
			//  printf("Current character set: %s\n", $mysqli->character_set_name());
		}

    	return $this->mysqli;
    }
}
?>