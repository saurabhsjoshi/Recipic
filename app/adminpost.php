<?php
require('lib/session.php');
require('lib/dblibs.php');
initSession();
if(isInSession() && connectToDb() && checkIfUserIsAdmin($_SESSION['userId'])) {

	if(changeUserPrivilege($_POST['id'], $_POST['status'])){
		header('location: adminloginpage.php');
	}
	else {

	}
	
}
else {
	header("HTTP/1.1 401 Unauthorized");
	echo "Unauthorized!";
    exit;
}
?>