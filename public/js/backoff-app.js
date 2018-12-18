$(function() {

    // Alert on invitation button
    $('.invitation').click(function() {
        if (!confirm('Voulez-vous envoyer les invitations par email ?'))
            return false;
    });


    /**
     * Commun
     *
     */
    initDatepicker();


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


/**
 * Common
 */
function initDatepicker()
{
    $.fn.datepicker.dates['fr'] = {
        days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
        daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
        daysMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
        months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
        monthsShort: ["Jan", "Fév", "Mar", "Avr", "Mai", "Juin", "Juil", "Aoû", "Sep", "Oct", "Nov","Déc"],
    };

    $('.datepicker').datepicker({
        language: 'fr',
        format: 'dd/mm/yyyy',
        autoclose: true,
        weekStart:1,
        daysOfWeekHighlighted: '0,6'
    });

    // Auto open begin datepicker & on select date begin auto open end datepicker and set the min day selectable
    $('[data-name="begin"]').on('changeDate', function(e) {
        var end = $(this).closest('tr').find('[data-name="end"]');
        end.datepicker('setStartView' , $(this).val());
        end.datepicker('setStartDate' , $(this).val());
        end.datepicker('show');
    });
}