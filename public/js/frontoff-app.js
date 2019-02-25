$(function() {

    init();

    // SPE LN
    $('#SPE-user-form').on('submit',function () {
        var name = $('#SPE-email').val().split('@');
        var splitName = name[0].split('.');
        $('#SPE-firstname').val(splitName[0]);
        $('#SPE-lastname').val(splitName[1]);
        $('#SPE-email').val(name[0]+'@ca-normandie-seine.fr');
        return true;
    });

    // SPE LN
    if ($('#meeting-room').length > 0) {
        meetingRooms();
        window.onresize = meetingRooms;

        $('#meeting-room .room').click(function () {
            $('#SPE-room').val($(this).data('value'));
            $('#SPE-room-form').submit();
        });
    }


    // SPE LN
    if ($('#SPE-email').length > 0) {
        var time = new Date().getTime();
        $(document.body).bind("mousemove keypress", function(e) {
            time = new Date().getTime();
        });

        function refresh() {
            if(new Date().getTime() - time >= 60000)
                window.location.reload(true);
            else
                setTimeout(refresh, 10000);
        }

        setTimeout(refresh, 10000);
    }

    // SPE LN
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });

    $('#result-range').on('input' , function(){
        $('#result-range').attr('data-first' , 0);
        displayEmote();
        $('.next').addClass('active');
    });

    $('#result-range[data-first="1"]').on('click', function () {
        $('#result-range').attr("value",'0').attr('data-first' , 0);
        $('#result-range').trigger('input');
    });

    $('#nsp').click(function(){
        $('input[name="result"]').attr('data-first','0').attr('min','-1').val(-1);
        $('#survey-form').submit();
    });

    $('#survey-form').on('submit', function () {
        if ($('#result-range').attr('data-first') == '1') {
            alert('Merci de sélectionner une note pour valider cette question.');
            return false;
        }
    });

    $('.open-graph').on('click', function () {
        $.ajax({
            method: "GET",
            url: $(this).data('link'),
            data: {}
        })
        .done(function( data ) {
            //$('#content-modal').html(data.html);

            Highcharts.chart('container', {

                title: {
                    text: 'Moyennes des réponses'
                },

                subtitle: {
                    text: $('#wording-'+data.key).text()
                },

                yAxis: {
                    title: {
                        text: 'Notes'
                    }
                },

                xAxis: {
                    title: {
                        text: 'Questionnaire'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },

                series: [
                    {
                        name: "Moyenne",
                        data: data.average
                    },
                    {
                        name: "Vous",
                        data: data.user
                    }
                ],

                plotOptions: {
                    series: {
                        pointStart: 1
                    }
                },

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }

            });
            $('.highcharts-credits').hide();
            $('.highcharts-contextbutton').hide();
            $('#modal').modal('toggle');

        });



    });
    

});


function displayEmote() 
{
    var result = $('#result-range').attr('data-first') == '0' ? $('#result-range').val() : -1;
    $('.emote').addClass('d-none');
    $('.emote[data-smile="'+result+'"]').removeClass('d-none');
}

function init() 
{
    if ($('#result-range').length > 0) {
        displayEmote();
    }
}

/**
 * Common
 * @param email
 * @returns {boolean}
 */
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// SPE LN
function meetingRooms() {
    var width = $('#meeting-room .room-3').css('width').replace('px','');
    $('#meeting-room .room').css('height',width/2.05);
}