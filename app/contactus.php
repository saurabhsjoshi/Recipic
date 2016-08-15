<?php
require('lib/session.php');
initSession();
$LOGGED_IN = isInSession();
?>
<!doctype html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recipic: Contact Us</title>
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- build:css styles/vendor.css -->
    <!-- bower:css -->
    <!-- endbower -->
    <!-- endbuild -->

    <!-- build:css styles/main.css -->
    <link rel="stylesheet" href="styles/main.css">
    <!-- endbuild -->

  </head>
  <body>
    <div class="overlay">
    </div>
    <div class="container">
		<nav>
			<h1 class="logo">Recipic</h1>
			<ul>
				<li id="homelink">Home</li>
        <li id="aboutlink">About Us</li>
				<li id="contactlink" class="active">Contact Us</li>
                <?php
                if($LOGGED_IN){
echo <<<ZZEOF
                    <li id="profilelink" class="negative">{$_SESSION['name']} &#9660;</li>
ZZEOF;
                } else {
                    echo '<li id="loginlink" class="negative">Log In</li>';
                }
                ?>
			</ul>
		</nav>
		<div class="content">
      <div class="contactcard">
        <h2>Contact Us</h2>
        <p>Got any questions or concerns? Please feel free to contact us using the form below. We will get back to you as soon as possible.</p>
  			<form class="contactform" method="post">
  			  <input type="text"  name="name"    autocomplete="name"  placeholder="Name" autofocus required>
          <input type="email" name="email"   autocomplete="email" placeholder="Email" required>
          <input type="text"  name="subject" autocomplete="on"    placeholder="Subject" required>
          <textarea name="message" rows="8" cols="40" placeholder="Message" required></textarea>
          <input type="submit" value="Submit">
  			</form>
      </div>
		</div>
	</div>

    <!-- build:js scripts/vendor.js -->
    <!-- bower:js -->
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <!-- endbower -->
    <!-- endbuild -->

    <!-- build:js scripts/main.js -->
    <script src="scripts/main.js"></script>
    <!-- endbuild -->
  </body>
</html>
