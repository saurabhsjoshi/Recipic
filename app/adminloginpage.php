<?php
require('lib/session.php');
require('lib/dblibs.php');
initSession();
if(isInSession() && connectToDb() && checkIfUserIsAdmin($_SESSION['userId'])) {
	echo <<<ZZEOF
	<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recipic: Admin Panel</title>
		<link rel="stylesheet" href="styles/main.css">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
  </head>
  <body>
	<div class="overlay"></div>
<div class="container">
		<nav>
				<h1 class="logo">Recipic</h1>
				<ul>
						<li id="homelink" class="active">Home</li>
						<li id="aboutlink">About Us</li>
						<li id="contactlink">Contact Us</li>
						<li id="profilelink" class="negative">{$_SESSION["name"]}</li>
						<li id="adminLogin" class="negative">Admin Panel</li>
		</ul>
		<div class="fab-box">
<button id="addRecipeButton" class="fab dark-fab">+</button>
<button class="fab red-fab" onclick="window.location.href='logout.php'">
		<svg version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="1em" height="1em" viewBox="-0.8 -0.5 177 202" xml:space="preserve">
				<defs>
				</defs>
				<path fill="none" stroke="#FFF" stroke-width="30" stroke-linecap="round" d="M33.7,64.3C22.1,77.2,15,94.3,15,113
c0,40.1,32.5,72.7,72.7,72.7c40.1,0,72.7-32.5,72.7-72.7c0-18.7-7.1-35.8-18.7-48.7" />
				<line fill="none" stroke="#FFF" stroke-width="30" stroke-linecap="round" x1="87.8" y1="15" x2="87.8" y2="113" />
		</svg>
</button>
</div>
		</div>
</nav>
<div class="content">
  <table>
     <tr>
         <th>ID</th>
         <th>User Name</th>
         <th>Actions</th>
     </tr>
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
</div>
</body>
<script src="scripts/admin.js"></script>
<script src="scripts/main.js"></script>
</html>
ZZEOF;
}

else {
	header("HTTP/1.1 401 Unauthorized");
	echo "Unauthorized!";
    exit;
}
?>
