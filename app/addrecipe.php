<?php
require('lib/session.php');
require('lib/dblibs.php');
initSession();
if(!isInSession()){
  header('location: index.php');
}

?>
<!DOCTYPE html>
<html>
<body>
<form action="recipepost.php" method="post">
  Title:<br>
  <input type="text" name="title">
  <br>
  Ingredients:<br>
  <textarea name="ingredients" rows="1" cols="50"></textarea>
  <br>
  Instructions:<br>
  <textarea name="instructions" rows="4" cols="50"></textarea>
  <br>
  <input type="submit" value="Submit">
</form>
</body>
</html>
