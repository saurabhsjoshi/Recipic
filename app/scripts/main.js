$( document ).ready(function() {
    $('.overlay .login .prompt .text-link').click(function() {
        $('.hiddenLoginInput').toggle();
        $('.overlay .login .prompt .login-prompt').toggle();
        $('.overlay .login .prompt .signup-prompt').toggle();
    });

    $('.negative').click(function() {
      $('.overlay').toggle("slow");
    });

    // $('.overlay').click(function() {
    //   $('.overlay').toggle("slow");
    // });
});
