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

    <div class="container">
		<nav>
			<h1 class="logo">Recipic</h1>
			<ul>
				<li class="active">Home</li>
        		<li>About Us</li>
				<li>Contact Us</li>
                <?php
                if($LOGGED_IN){
echo <<<ZZEOF
                    <li class="negative">{$_SESSION['name']}</li>
ZZEOF;
                } else {
                    echo '<li class="negative">Log In</li>';
                }
                ?>
			</ul>
		</nav>
		<!-- <div class="content">
            <div class="card"><img src="http://mikes-table.themulligans.org/wp-content/uploads/2009/01/potato_ricotta_gnocchi-7.jpg" alt="Potato Ricotta Gnocchi"><span>Potato Ricotta Gnocchi</span></div>
            <div class="card"><img src="https://sophnstuff.files.wordpress.com/2013/01/dsc_0086-copy1.jpg" alt="Tomato Ravioli"><span>Tomato Ravioli</span></div>
            <div class="card"><img src="http://www.ingredientsnetwork.com/47/pdcnewsitem/03/77/22/3.jpg" alt="Rotini"><span>Rotini Pasta</span></div>
            <div class="card"><img src="http://viafratelli.com/wp-content/uploads/2015/02/crabmeat-pasta.jpg" alt="Crabmeat Spaghetti"><span>Crabmeat Spaghetti</span></div>
            <div class="card"><img src="http://mikes-table.themulligans.org/wp-content/uploads/2009/01/potato_ricotta_gnocchi-7.jpg" alt="Potato Ricotta Gnocchi"><span>Potato Ricotta Gnocchi</span></div>
            <div class="card"><img src="https://sophnstuff.files.wordpress.com/2013/01/dsc_0086-copy1.jpg" alt="Tomato Ravioli"><span>Tomato Ravioli</span></div>
            <div class="card"><img src="http://www.ingredientsnetwork.com/47/pdcnewsitem/03/77/22/3.jpg" alt="Rotini"><span>Rotini Pasta</span></div>
            <div class="card"><img src="http://viafratelli.com/wp-content/uploads/2015/02/crabmeat-pasta.jpg" alt="Crabmeat Spaghetti"><span>Crabmeat Spaghetti</span></div>
            <div class="card"><img src="http://mikes-table.themulligans.org/wp-content/uploads/2009/01/potato_ricotta_gnocchi-7.jpg" alt="Potato Ricotta Gnocchi"><span>Potato Ricotta Gnocchi</span></div>
            <div class="card"><img src="https://sophnstuff.files.wordpress.com/2013/01/dsc_0086-copy1.jpg" alt="Tomato Ravioli"><span>Tomato Ravioli</span></div>
            <div class="card"><img src="http://www.ingredientsnetwork.com/47/pdcnewsitem/03/77/22/3.jpg" alt="Rotini"><span>Rotini Pasta</span></div>
            <div class="card"><img src="http://viafratelli.com/wp-content/uploads/2015/02/crabmeat-pasta.jpg" alt="Crabmeat Spaghetti"><span>Crabmeat Spaghetti</span></div>
            <div class="card"><img src="http://mikes-table.themulligans.org/wp-content/uploads/2009/01/potato_ricotta_gnocchi-7.jpg" alt="Potato Ricotta Gnocchi"><span>Potato Ricotta Gnocchi</span></div>
            <div class="card"><img src="https://sophnstuff.files.wordpress.com/2013/01/dsc_0086-copy1.jpg" alt="Tomato Ravioli"><span>Tomato Ravioli</span></div>
            <div class="card"><img src="http://www.ingredientsnetwork.com/47/pdcnewsitem/03/77/22/3.jpg" alt="Rotini"><span>Rotini Pasta</span></div>
            <div class="card"><img src="http://viafratelli.com/wp-content/uploads/2015/02/crabmeat-pasta.jpg" alt="Crabmeat Spaghetti"><span>Crabmeat Spaghetti</span></div>
            <div class="card"><img src="http://mikes-table.themulligans.org/wp-content/uploads/2009/01/potato_ricotta_gnocchi-7.jpg" alt="Potato Ricotta Gnocchi"><span>Potato Ricotta Gnocchi</span></div>
            <div class="card"><img src="https://sophnstuff.files.wordpress.com/2013/01/dsc_0086-copy1.jpg" alt="Tomato Ravioli"><span>Tomato Ravioli</span></div>
            <div class="card"><img src="http://www.ingredientsnetwork.com/47/pdcnewsitem/03/77/22/3.jpg" alt="Rotini"><span>Rotini Pasta</span></div>
            <div class="card"><img src="http://viafratelli.com/wp-content/uploads/2015/02/crabmeat-pasta.jpg" alt="Crabmeat Spaghetti"><span>Crabmeat Spaghetti</span></div>
		</div> -->

    <div class="content">
      <div class="login">
        <form method="post" action="login.php">
          <label>Username<br />
          <input type="text" name="username" autocomplete="username" autofocus="true" required></label><br />
          <label>Password<br />
          <input type="password" name="password" autocomplete="off" required></label>
          <input type="submit" value="Log In">
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
