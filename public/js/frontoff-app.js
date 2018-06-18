$(function() {

    init();

    $('#result-range').on('change' , function(){
        displayEmote();
    });
    

});


function displayEmote() 
{
    var result = $('#result-range').val();
    console.log('coucou ' + result);
    $('.emote').addClass('d-none');
    $('.emote[data-smile="'+result+'"]').removeClass('d-none');
}

function init() 
{
    if ($('#result-range').length > 0) {
        displayEmote();
    }
}