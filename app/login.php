<?php
/*require_once('lib/lib.php');
require_once('lib/dblibs.php');
//require_once(dirname(__FILE__).'/lib/lib.php');

output_html5_header(
  'My First Page',
  array( "css/common.php")
);

output_page_header();
output_page_menu();
output_login_page_content();
output_page_footer();

output_html5_footer();
if (connectToDb()){
	signInUser('joshio', 'password');
}*/
require_once('lib/dblibs.php');
require_once('lib/session.php');
use function \FluidXml\fluidxml;
header('Content-Type: application/xml');

$result = fluidxml("result");
signUserIn();
echo $result->xml();

function signUserIn() {
    global $result;
    if(!isset($_POST['username']) || !isset($_POST['password'])) {
        $result->add('Status', 399)->add('Message', 'All parameters not passed');
        return;
    }
    
    if(connectToDb()){
        if(signInUser($_POST['username'], $_POST['password'])){
            header('location: index.php');
        }
        else {
            $result->add('Status', 400)->add('Message', 'Username/Password is incorrect!');
            return;
        }
    }
    else {
        $result->add('Status', 402)->add('Message', 'Could not connect to database. Please try again later.');
        return;
    }
}
?>
