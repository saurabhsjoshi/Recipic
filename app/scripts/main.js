$( document ).ready(function() {
    $('.overlay .login .prompt .text-link').click(function() {
        $('.hiddenLoginInput').removeClass('display', 'block');
        $('.overlay.login.prompt').html('Already have an account? <span class="text-link" onclick="showLogInForm()">Log In!</span>');
    });
});
