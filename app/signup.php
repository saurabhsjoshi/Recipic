<?php
require_once('lib/dblibs.php');
require_once('lib/FluidXml.php');
use function \FluidXml\fluidxml;
header('Content-Type: application/xml');

$result = fluidxml("result");
signUserUp();
echo $result->xml();

function signUserUp() {
	global $result;
	if(!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['name']) || !isset($_POST['username'])){
		$result->add('Status', 399)->add('Message', 'All parameters not passed');
		return;
	}

	if(connectToDb()) {
		if(checkIfEmailExists($_POST['email'])) {
			$result->add('Status', 400)->add('Message', 'Email already exists');
			return;
		}

		if (checkIfUsernameExists($_POST['username'])) {
			$result->add('Status', 401)->add('Message', 'Username already exists');
			return;
		}

		if(signUpUser($_POST['username'], $_POST['password'], $_POST['email'], $_POST['name'])) {
			$result->add('Status', 200)->add('Message', 'Account created');
			return;
		} else {
			$result->add('Status', 402)->add('Message', 'Unknown error. Please contact us.');
			return;
		}
	}
}


?>
