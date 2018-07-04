$(function() {

    // Alert on invitation button
    $('.invitation').click(function() {
        if (!confirm('Voulez-vous envoyer les invitations par email ?'))
            return false;
    });


});
