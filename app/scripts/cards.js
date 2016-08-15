'use strict';

var card_index = 1;
var path = "media/images/";
//Functions
function appendRecipeCard(recipeName, recipeImg) {
    var card = "<div class=\"card\"><img src=\"http://mikes-table.themulligans.org/wp-content/uploads/2009/01/potato_ricotta_gnocchi-7.jpg\" alt=\"" + recipeName + "\"><span>" + recipeName + "</span></div>";
    $('.content').append(card);
}

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
        .done(function (data) {

            $(data).find('recipe').each(function () {
                card_index++;
                appendRecipeCard($(this).find('Title').text());
            });
        })
        .fail(function (data) {
            alert("Error parsing recipes");
            /* TODO: Specify error messages using if-else statements */
            // alert("error");
        });
}

function init() {
    loadCards();
}

init();