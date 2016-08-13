<?php
require_once __DIR__.'/../config.php';
require_once('lib.php');
require_once('session.php');
require_once('FluidXml.php');
use function \FluidXml\fluidxml;
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
		$uid = $db_connection_handle->lastInsertId();
		startSession($uid, $username, $name);
		return TRUE;
	} catch(PDOException $e){
		debug_to_console ('Insert ERROR: '.$e->getMessage()."\n");
		return FALSE;
	}
}

function checkIfUsernameExists($username) {
	try {
		global $db_connection_handle;
		$user_array = array(
			':username' => $username);
		$sql = 'SELECT COUNT(*) AS count FROM users WHERE username=:username';
		$st = $db_connection_handle->prepare($sql);
		$st->execute($user_array);
		$result = $st->fetch(PDO::FETCH_ASSOC);
		if($result['count'] > 0){
			debug_to_console("Found user");
			return TRUE;
		} else {
			debug_to_console("User not found");
			return FALSE;
		}
	} catch (Exception $e) {
		debug_to_console('Select ERROR: ' . $e->getMessage()."\n");
		return FALSE;
	}
}

function checkIfEmailExists($email) {
	try {
		global $db_connection_handle;
		$user_array = array(
			':email' => $email);
		$sql = 'SELECT COUNT(*) AS count FROM users WHERE email=:email';
		$st = $db_connection_handle->prepare($sql);
		$st->execute($user_array);
		$result = $st->fetch(PDO::FETCH_ASSOC);
		if($result['count'] > 0){
			debug_to_console("Found user");
			return TRUE;
		} else {
			debug_to_console("User not found");
			return FALSE;
		}

	} catch (Exception $e) {
		debug_to_console('Select ERROR: ' . $e->getMessage()."\n");
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

function getRecipesFromId($id) {
	try{
		global $db_connection_handle;

		$user_array = array(':id' => $id);
		$sql = 'SELECT users.name, users.id AS uid, recipes.id, title, content, recipes.dateCreated, dateModified FROM recipes INNER JOIN users ON recipes.u_id = users.id WHERE recipes.id>=:id LIMIT 10';
		$st = $db_connection_handle->prepare($sql);
		$st->execute($user_array);
		$recipes = fluidxml('Recipes');
		while($result = $st->fetch(PDO::FETCH_ASSOC)){
			$xcontent = fluidxml($result['content']);
			$xcontent->add('Id', $result['id']);
			$xcontent->add('Title', $result['title']);
			$xcontent->add('Author', $result['name']);
			$xcontent->add('AuthorID', $result['uid']);
			$xcontent->add('Dates', true)
			->add('DateCreated', $result['datecreated'])
			->add('DateModified', $result['datemodified']);
			$recipes->add($xcontent);
		}
		//print_r($result);
		
		return $recipes->xml();
	} catch(PDOException $e){
		debug_to_console ('Select ERROR: '.$e->getMessage()."\n");
		return "";
	}
}

function getRecipeById($id) {
	try{
		global $db_connection_handle;

		$user_array = array(':id' => $id);
		$sql = 'SELECT users.name, users.id AS uid, recipes.id, title, content, recipes.dateCreated, dateModified FROM recipes INNER JOIN users ON recipes.u_id = users.id WHERE recipes.id=:id';
		$st = $db_connection_handle->prepare($sql);
		$st->execute($user_array);
		$result = $st->fetch(PDO::FETCH_ASSOC);
		//print_r($result);
		$xcontent = fluidxml($result['content']);
		$xcontent->add('Id', $result['id']);
		$xcontent->add('Title', $result['title']);
		$xcontent->add('Author', $result['name']);
		$xcontent->add('AuthorID', $result['uid']);
		$xcontent->add('Dates', true)
				->add('DateCreated', $result['datecreated'])
				->add('DateModified', $result['datemodified']);

		return $xcontent->xml();
	} catch(PDOException $e){
		debug_to_console ('Select ERROR: '.$e->getMessage()."\n");
		return "";
	}
}

function saveRecipe($title, $content, $uid) {
	try{
		global $db_connection_handle;

		$user_array = array(
			':title' => $title,
			':content' => $content,
			':u_id' => $uid);

		$sql = 'INSERT INTO recipes (title, content, u_id, dateCreated) VALUES (:title, :content, :u_id, NOW())';
		$st = $db_connection_handle->prepare($sql);
		$st->execute($user_array);
		return TRUE;
	} catch(PDOException $e){
		debug_to_console ('Insert ERROR: '.$e->getMessage()."\n");
		return FALSE;
	}
}

function updateRecipe($recipeId, $title, $content) {
	try{
		global $db_connection_handle;

		$user_array = array(
			':title' => $title,
			':content' => $content,
			':id' => $recipeId);

		$sql = 'UPDATE recipes SET title=:title, content=:content, dateModified=NOW(), WHERE id=:id';
		$st = $db_connection_handle->prepare($sql);
		$st->execute($user_array);
		return TRUE;
	} catch(PDOException $e){
		debug_to_console ('Insert ERROR: '.$e->getMessage()."\n");
		return FALSE;
	}
}

function getAllRecipesByUser($id) {
	$recipeList = array();
	try{
		$user_array = array(':id' => $id);
		$sql = 'SELECT id, title, content, dateCreated, dateModified FROM recipes WHERE u_id=:id';
		$st = $db_connection_handle->prepare($sql);
		$st->execute($user_array);
		while($result = $st->fetch(PDO::FETCH_ASSOC)){
			array_push($recipeList, $result);
		}
	} catch(PDOException $e) {
		debug_to_console ('Select ERROR: '.$e->getMessage()."\n");
	}
	return $recipeList;
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