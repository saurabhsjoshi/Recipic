<?php 
require('lib/session.php');
require('lib/dblibs.php');
initSession();
if(isInSession() && connectToDb() && checkIfUserIsAdmin($_SESSION['userId'])) {
	echo <<<ZZEOF
	<!doctype html>
<html lang="">
  <head>
  	<script src="scripts/admin.js"></script>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recipic</title>
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
  </head>
  <body>
  <table>
  	<thead>
                       <tr>
                           <th>ID</th>
                           <th>User Name</th>
                           <th>Actions</th>
                       </tr>
    </thead>
ZZEOF;
	
	$userList = getAllUsers($_SESSION['userId']);

	foreach ($userList as $user) {
echo <<<ZZEOF
	<tr>
		<td>{$user['id']}</td>
		<td>{$user['username']}</td>
ZZEOF;
		if($user['status'] == 0) {
echo <<<ZZEOF
	<td><button onclick="sendPost({$user['id']}, 1)">Revoke Admin</button></td><tr>
ZZEOF;
		} 
		else {
echo <<<ZZEOF
	<td><button onclick="sendPost({$user['id']}, 0)">Make Admin</button></td><tr>
ZZEOF;
		}
	}
echo <<<ZZEOF
</table>
</body>
</html>
ZZEOF;
}

else {
	header("HTTP/1.1 401 Unauthorized");
	echo "Unauthorized!";
    exit;
}
?>