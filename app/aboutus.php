<?php
require('lib/session.php');
initSession();
$LOGGED_IN = isInSession();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recipic: About Us</title>
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
  				<li id="homelink" class="active">Home</li>
          <li id="aboutlink">About Us</li>
  				<li id="contactlink">Contact Us</li>
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
			<div class="aboutcard">
        <h2>About Us</h2>
			  <p>
			    The new age digital handbook for the aspiring chef. Featuring recipes that range from beginner level to expert level, Recipic is the one stop destination for all your culinary combination needs.
			  </p>
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
<?php ?>