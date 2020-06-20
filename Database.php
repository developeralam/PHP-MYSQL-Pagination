<?php
/**
 * Dtabase Class
 */
class Database
{
	public $host = "localhost";
	public $user = "root";
	public $pass = "";
	public $name = "db_api";
	public $link;
	
	function __construct()
	{
		$this->connectDB();
	}
	public function connectDB()
	{
		$this->link = new mysqli($this->host, $this->user, $this->pass, $this->name);
	}
}