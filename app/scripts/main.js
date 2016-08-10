$( document ).ready(function() {
    $('.overlay .login .prompt .text-link').click(function() {
        $('.hiddenLoginInput').toggle();
        $('.overlay .login .prompt .login-prompt').toggle();
        $('.overlay .login .prompt .signup-prompt').toggle();
    });

    $('.negative').click(function() {
      $('.overlay').toggle("slow");
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
            /* TODO: Show error messages */
            $status = $(data).find('Status').text();
            
            if($status == 400) {
                //Email already exists
                console.log($(data).find('Message').text());

            } else if ($status == 401){
                //Username already exists
                console.log($(data).find('Message').text());
            } else if ($status = 200) {
                //Signed up and logged in
                window.location = "/app";
            }
        });

        event.preventDefault();
    });

    // $('.overlay').click(function() {
    //   $('.overlay').toggle("slow");
    // });
});
