<?php
function initSession(){
	session_start();
}

function startSession($userId, $userName, $name) {
	initSession();
	$_SESSION['is_auth'] = true;
	$_SESSION['userId'] = $userId;
	$_SESSION['userName'] = $userName;
	$_SESSION['name'] = $name;
}

function isInSession() {
	if(!isset($_SESSION['is_auth']))
		return FALSE;
	else
		return TRUE;
}

function exitSession(){
	unset($_SESSION['is_auth']);
	session_destroy();
}

?>