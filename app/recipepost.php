<?php
require_once('lib/session.php');
require_once('lib/dblibs.php');
require_once('lib/FluidXml.php');
use function \FluidXml\fluidxml;
initSession();

if(connectToDb()){
	//Content in XML format
	$xcontent = fluidxml('recipe');
	$xcontent->add('ingredients', $_POST['ingredients']);
	$xcontent->add('instructions', $_POST['instructions']);
	if(saveRecipe($_POST['title'], $xcontent->xml(), $_SESSION['userId'])){
		header('location: index.php');
	}
}

?>