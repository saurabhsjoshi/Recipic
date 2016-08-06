$( document ).ready(function() {
    for(var i = 0; i < 10; i++) {
        $('.content').append('<div class="card"><img src="http://www.mnftiu.cc/wp-content/uploads/2013/12/spaghetti-with-tomato-sauce.jpg" alt="Pasta Image"><p>Fucking pasta</p></div>');    
    }

    $('.card').click(function() {
        console.log("click recorded");
    });
});