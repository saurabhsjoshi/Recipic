<?php
require_once('lib/session.php');
initSession();
exitSession();
header('location: main.php');
?>