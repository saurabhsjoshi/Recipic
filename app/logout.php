<?php
require_once('lib/session.php');
initSession();
exitSession();
header('location: index.php');
?>
