<?php

	function get_db(){
		$hostname = 'localhost';
		$db_name = 'PROTOCOL_DB';
		$user_name = 'root';
		$password = '';

		return new PDO("mysql:host=$hostname;dbname=$db_name", $user_name, $password);
	}

?>