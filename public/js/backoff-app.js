$(function() {

    // Alert on invitation button
    $('.invitation').click(function() {
        if (!confirm('Voulez-vous envoyer les invitations par email ?'))
            return false;
    });


    $('.contributors').click(function() {

        var key = $(this).data('key');
        var href = $(this).data('href');

        $.ajax({
                method: "GET",
                url: href,
                data: {key : key}
            })
            .done(function( data ) {
                $('#users .modal-body').html(data.html);
            });
        });

});
