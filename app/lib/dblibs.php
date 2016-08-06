<?php
require_once __DIR__.'/../config.php';
require_once('lib.php');
require_once('session.php');

$db_connection_handle = NULL;
$DEBUG_MODE = FALSE;

function connectToDb() {
	try{
		global $DBUSER, $DBPASS, $DBNAME, $db_connection_handle;
		$db_connection_handle = 
		new PDO("mysql:host=127.0.0.1;dbname=$DBNAME", $DBUSER, $DBPASS);

		$db_connection_handle->
		setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db_connection_handle->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
		$db_connection_handle->
		setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL);
		debug_to_console("Connected!");
		return TRUE;
	} catch (PDOException $e) {
		debug_to_console ('PDO ERROR: '.$e->getMessage()."\n");
		return FALSE;
	}
}

function signUpUser($username, $password, $email, $name) {
	try{
		global $db_connection_handle;
		$pass_hash = sha1($password);

		$user_array = array(
			':username' => $username, 
			':password' => $pass_hash,
			':email' => $email,
			':name' => $name,
			':status' => 1);

		$sql = 'INSERT INTO users (username, password, email, name, status) VALUES (:username, :password, :email, :name, :status)';
		$st = $db_connection_handle->prepare($sql);
		$st->execute($user_array);
		return TRUE;
	} catch(PDOException $e){
		debug_to_console ('Insert ERROR: '.$e->getMessage()."\n");
		return FALSE;
	}
}

function signInUser($username, $password) {
	try{
		global $db_connection_handle;
		$pass_hash = sha1($password);

		$user_array = array(':username' => $username);
		$sql = 'SELECT id, password, name FROM users WHERE username=:username LIMIT 1';
		$st = $db_connection_handle->prepare($sql);
		$st->execute($user_array);
		$result = $st->fetch(PDO::FETCH_ASSOC);
		if (strcmp($result['password'], $pass_hash) == 0){
			startSession($result['id'], $username, $result['name']);
			debug_to_console("Logged In!");
			return TRUE;
		}
		else{
			debug_to_console("Wrong Password!");
			return FALSE;
		}
	} catch(PDOException $e){
		debug_to_console ('Select ERROR: '.$e->getMessage()."\n");
		return FALSE;
	}
}

function debug_to_console( $data ) {
	global $DEBUG_MODE;
	if(!$DEBUG_MODE)
		return;
	if ( is_array( $data ) )
		$output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
	else
		$output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
	echo $output;
}



?>