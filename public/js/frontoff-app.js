$(function() {

    init();

    $('#result-range').on('input' , function(){
        displayEmote();
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
    var result = $('#result-range').val();
    $('.emote').addClass('d-none');
    $('.emote[data-smile="'+result+'"]').removeClass('d-none');
}

function init() 
{
    if ($('#result-range').length > 0) {
        displayEmote();
    }
}