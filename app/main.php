<!DOCTYPE html>
<html>
<body>

<form action="login.php" method="post">
  Username:<br>
  <input type="text" name="username">
  <br>
  Password:<br>
  <input type="password" name="password">
  <input type="submit" value="Submit">
</form>
</body>
</html>
<?php
/* require_once('lib/lib.php');
//require_once(dirname(__FILE__).'/lib/lib.php');

output_html5_header(
  'My First Page',
  array( "css/common.php")
);

output_page_header();
output_page_menu();
output_home_page_content();
output_page_footer();

output_html5_footer(); */

require_once('lib/session.php');
require_once('lib/dblibs.php');
?>

