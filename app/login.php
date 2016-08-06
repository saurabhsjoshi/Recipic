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
if(connectToDb()){
	if(signInUser($_POST['username'], $_POST['password'])){
		header('location: index.php');
	}
}
?>
