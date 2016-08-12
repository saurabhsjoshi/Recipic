$( document ).ready(function() {
    let overlayOpen = false;

    $('.overlay .login .prompt .text-link').click(function() {
        $('.hiddenLoginInput').toggle();
        $('.overlay .login .prompt .login-prompt').toggle();
        $('.overlay .login .prompt .signup-prompt').toggle();
    });

    $('#loginlink').click(function() {
      $('.overlay').toggle("slow");
      overlayOpen = true;
    });

    $("#signUpForm").submit(function(event) {
        var formData = {
            'username' : $('input[name=username]').val(),
            'email' : $('input[name=email').val(),
            'password' : $('input[name=password]').val(),
            'name' : $('input[name=name]').val()
        };
        $.ajax({
            type : 'POST',
            url : 'signup.php',
            data : formData,
            dataType : 'xml',
            encode : true
        })
        .done(function(data) {
            $status = $(data).find('Status').text();

            if($status == 400) {
                //Email already exists
                console.log($(data).find('Message').text());

            } else if ($status == 401) {
                //Username already exists
                console.log($(data).find('Message').text());
            } else if ($status = 200) {
                //Signed up and logged in
                location.reload(true);
            }
        })
        .fail(function(data) {
          /* TODO: Specify error messages using if-else statements */
          alert("error");
        });

        event.preventDefault();
    });

    // Load about page when "About Us" button is clicked
    $('nav ul #aboutlink').click(function() {
      $('.content').load('/app/about.php .content');
    });

    // Load contact page when "Contact Us" button is clicked
    $('nav ul #contactlink').click(function() {
      $('.content').load('/app/contact.php .content');
    });

    // Close login modal if overlay is clicked
    $('#close').click(function () {
      $('.overlay').toggle("slow");
      overlayOpen = false;
    });

    $(document).keyup(function(e) {
      if(e.which == 27 && overlayOpen) {
        $('.overlay').toggle("slow");
        overlayOpen = false;
      }
    });
});
