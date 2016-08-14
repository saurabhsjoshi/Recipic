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
    <title>Recipic</title>
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
      <a id="close" href="#"></a>
      <div class="login">
        <h2>Recipic</h2>
        <div class="loginError">
          <span id="loginErrorMessage"></span>
          <span id="loginErrorClose">X</span>
        </div>
        <form id="signUpForm" method="post" action="signup.php">
          <input type="text"     name="name"     autocomplete="name"             placeholder="Full Name" required>
          <input type="username" name="username" autocomplete="username"         placeholder="Username"  required>
          <input type="email"    name="email"    autocomplete="email"            placeholder="Email"     required>
          <input type="password" name="password" autocomplete="current-password" placeholder="Password"  required>
          <input type="submit"   value="Sign Up">
        </form>
        <form id="logInForm" method="post" action="login.php">
          <input type="username" name="username" autocomplete="username"         placeholder="Username"  required>
          <input type="password" name="password" autocomplete="current-password" placeholder="Password"  required>
          <input type="submit"   value="Log In">
        </form>
        <div class="prompt">
          <span class="signup-prompt">
            Need an account? <span class="text-link">Sign up!</span>
          </span>
          <span class="login-prompt">
            Already have an account? <span class="text-link">Log In!</span>
          </span>
        </div>
      </div>
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
