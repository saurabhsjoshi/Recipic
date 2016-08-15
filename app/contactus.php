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
                    <li id="homelink" class="active">Home</li>
                    <li id="aboutlink">About Us</li>
                    <li id="contactlink">Contact Us</li>
                    <?php
                if($LOGGED_IN){
echo <<<ZZEOF
                    <li id="profilelink" class="negative">{$_SESSION['name']} &#9660;</li>
                    </ul>
                    <div class="fab-box">
                <button class="fab dark-fab">+</button>
                <button class="fab red-fab">
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
ZZEOF;
                } else {
                    echo '<li id="loginlink" class="negative">Log In</li></ul>';
                }
                ?>
            </nav>
            <div class="content">
                <div class="contactcard">
                    <h2>Contact Us</h2>
                    <p>Got any questions or concerns? Please feel free to contact us using the form below. We will get back to you as soon as possible.</p>
                    <form class="contactform" method="post">
                        <input type="text" name="name" autocomplete="name" placeholder="Name" autofocus required>
                        <input type="email" name="email" autocomplete="email" placeholder="Email" required>
                        <input type="text" name="subject" autocomplete="on" placeholder="Subject" required>
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