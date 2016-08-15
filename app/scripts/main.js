$(document).ready(function() {
    // Load static parts
    $('.overlay').load('overlay.html');

    //Variables
    let overlayOpen = false;
    let card_index = 1;
    let signUpForm = $('#signUpForm');
    init();

    function init() {
        loadCards();
    }

    $('.overlay .login .prompt .text-link').click(function() {
        $('#logInForm').toggle();
        $('#signUpForm').toggle();
        $('.overlay .login .prompt .login-prompt').toggle();
        $('.overlay .login .prompt .signup-prompt').toggle();
    });

    $('#loginlink').click(function() {
        $('.overlay').toggle("slow");
        overlayOpen = true;
    });

    $("#signUpForm").submit(function(event) {
        event.preventDefault();
        var formData = {
            'username': $('input[name=username]').val(),
            'email': $('input[name=email').val(),
            'password': $('input[name=password]').val(),
            'name': $('input[name=name]').val()
        };
        $.ajax({
                type: 'POST',
                url: 'signup.php',
                data: formData,
                dataType: 'xml',
                encode: true
            })
            .done(function(data) {
                $status = $(data).find('Status').text();
                $message = $(data).find('Message').text();

                if ($status == 400) {
                    //Email already exists
                    $('.login').find('.loginError #loginErrorMessage').text('ERROR: ' + $message + ' (' + $status + ')');
                    $('.loginError').toggle();
                    $('#signUpForm input[name=email]').trigger("reset");
                    $('#signUpForm input[name=email]').focus();

                } else if ($status == 401) {
                    //Username already exists
                    $('.login').find('.loginError #loginErrorMessage').text('ERROR: ' + $message + ' (' + $status + ')');
                    $('.loginError').toggle();
                    $('#signUpForm input[name=username]').trigger("reset");
                    $('#signUpForm input[name=username]').focus();

                } else if ($status = 200) {
                    //Signed up and logged in
                    location.reload(true);
                }
            })
            .fail(function(data) {
                $status = $(data).find('Status').text();
                $message = $(data).find('Message').text();
                $('.login').find('.loginError #loginErrorMessage').text(`$message ($status)`);
                $('.loginError').toggle();
                /* TODO: Specify error messages using if-else statements */
                // alert("error");
            });

    });

    // Load about page when "About Us" button is clicked
    $('nav ul #aboutlink').click(function() {
        window.location.href = 'aboutus.php';
    });

    // Load contact page when "Contact Us" button is clicked
    $('nav ul #contactlink').click(function() {
        window.location.href = 'contactus.php';
    });

    // Load contact page when "Contact Us" button is clicked
    $('nav ul #homelink').click(function() {
        window.location.href = 'index.php';
    });

    // Close login modal if overlay is clicked
    $('#close').click(function() {
        $('.overlay').toggle("slow");
        overlayOpen = false;
    });

    function loadCards() {
        var formData = {
            'id': card_index
        };
        $.ajax({
                type: 'GET',
                url: 'test/recipeget.php',
                data: formData,
                dataType: 'xml',
                encode: true
            })
            .done(function(data) {

                $(data).find('recipe').each(function() {
                    card_index++;
                    appendRecipeCard($(this).find('Title').text());
                });
            })
            .fail(function(data) {
                alert("Error parsing recipes");
                /* TODO: Specify error messages using if-else statements */
                // alert("error");
            });
    }

    function appendRecipeCard(recipeName) {
        var card = "<div class=\"card\"><img src=\"http://mikes-table.themulligans.org/wp-content/uploads/2009/01/potato_ricotta_gnocchi-7.jpg\" alt=\"" + recipeName + "\"><span>" + recipeName + "</span></div>";
        $('.content').append(card);
    }

    $('#loginErrorClose').click(function() {
        $('.loginError').toggle();
    });

    // If open, close overlay on ESC keypressed
    $(document).keyup(function(e) {
        if (e.which == 27 && overlayOpen) {
            $('.overlay').toggle("slow");
            overlayOpen = false;
        }
    });

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
            loadCards();
        }
    });
});
