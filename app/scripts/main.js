$( document ).ready(function() {
    let overlayOpen = false;
    var card_index = 1;
    loadCards();

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
      $('.active').toggleClass("active");
      $('nav ul #aboutlink').toggleClass("active");
      $('.content').load('aboutus.html .content');
    });

    // Load contact page when "Contact Us" button is clicked
    $('nav ul #contactlink').click(function() {
      $('.active').toggleClass("active");
      $('nav ul #contactlink').toggleClass("active");
      $('.content').load('contactus.html .content');
    });

    // Load contact page when "Contact Us" button is clicked
    $('nav ul #homelink').click(function() {
      $('.active').toggleClass("active");
      $('nav ul #homelink').toggleClass("active");
      $('.content').load('index.php .content');
    });

    // Close login modal if overlay is clicked
    $('#close').click(function () {
      $('.overlay').toggle("slow");
      overlayOpen = false;
    });

    function loadCards(){
      var formData = {
        'id' : card_index
      };
      $.ajax({
        type : 'GET',
        url : 'test/recipeget.php',
        data : formData,
        dataType : 'xml',
        encode : true
      })
      .done(function(data) {
        
        $(data).find('recipe').each(function(){
          card_index++;
          appendRecipeCard($(this).find('Title').text());
        }); 
            })
      .fail(function(data) {
        /* TODO: Specify error messages using if-else statements */
        alert("error");
      });
    }

    function appendRecipeCard(recipeName){
      var card = "<div class=\"card\"><img src=\"http://mikes-table.themulligans.org/wp-content/uploads/2009/01/potato_ricotta_gnocchi-7.jpg\" alt=\"" + recipeName + "\"><span>"+ recipeName + "</span></div>";
      $('.content').append(card);
    }

    $(document).keyup(function(e) {
      if(e.which == 27 && overlayOpen) {
        $('.overlay').toggle("slow");
        overlayOpen = false;
      }
    });

    $(window).scroll(function() {
     if($(window).scrollTop() + $(window).height() == $(document).height()) {
      loadCards();
     }
   });
});


