$(function() {

    $('#select-room option[value=""]').text('Filtrer par salle de réunion');

    $('#select-room').change(function () {
        var room = $(this).val();
        var path = $(this).attr('basepath');
        var newPath = room != '' ? path+'/'+room : path;
        $(location).attr('href', newPath);
    });

    // Moyenne des réponses
    Highcharts.chart('graph', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Evolution des réponses'
        },
        yAxis: {
            title: {
                text: 'Note'
            },
            categories: [0,1,2,3,4,5]
        },
        xAxis: {
            categories: parseWording()
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Tout',
            data: parseDatas('all')
        }, {
            name: 'M-2',
            data: parseDatas('m2')
        }, {
            name: 'M-1',
            data: parseDatas('m1')
        }]
    });

    // Participation par trimestre
    Highcharts.chart('quarters', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Participation par trimestre'
        },
        xAxis: {
            categories: [""]
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 't1',
            data: parseQuarter(1)
        },{
            name: 't2',
            data: parseQuarter(2)
        },{
            name: 't3',
            data: parseQuarter(3)
        },{
            name: 't4',
            data: parseQuarter(4)
        },
        ]
    });

    // Participation par mois
    Highcharts.chart('months', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'M-1 / M'
        },
        xAxis: {
            categories: [""]
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'm-1',
            data: parseMonth(2)
        },{
            name: 'm',
            data: parseMonth(1)
        }
        ]
    });

    // Evolution sur 12 mois
    Highcharts.chart('question-evolution-year', {

        title: {
            text: 'Evolution des réponses sur 12 mois'
        },

        yAxis: {
            title: {
                text: 'Note'
            },
            categories: [0,1,2,3,4,5]
        },
        xAxis: {
            categories: parseEvolutionYear("period")
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                }
            }
        },

        series: parseEvolutionYear("datas")
        ,

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


    if ($('#rooms-stats').length > 0) {
        // Participation par room
        Highcharts.chart('rooms', {
            chart: {
                type: 'column'
            },
            title: {
                text: "Répartition de l'utilisation des salles"
            },
            xAxis: {
                categories: [""]
            },
            credits: {
                enabled: false
            },
            series: parseRoom()
        });
    }

})


function parseDatas(id)
{
    var datas = [];
    $('#'+id+' span').each(function () {
        datas.push(parseFloat(_.trim($(this).text())))
    })
    return datas
}

function parseWording()
{
    var datas = [];
    $('#wordings span').each(function () {
        datas.push(_.trim($(this).text()))
    })
    return datas
}

function parseQuarter(i)
{
    var datas = [];
    datas.push(parseInt(_.trim($('#quarters span[data-quarter="'+i+'"]').text())))
    return datas
}

function parseMonth(i)
{
    var datas = [];
    datas.push(parseInt(_.trim($('#months span[data-month="'+i+'"]').text())))
    return datas
}

function parseRoom()
{
    var datas = [];
    $('.room-stat').each(function () {
        datas.push( {name: $(this).data('name'), data : [parseInt($(this).text())]} );
    });
    return datas;
}

function parseEvolutionYear(need)
{
    var datas = [];
    var i = 1;
    $('.year-question').each(function () {
        var question_id = $(this).data('id');
        var tmp = [];
        libelle = [];
        $('.question-'+question_id).each(function () {
            libelle.push($(this).data('period'));
            tmp.push(parseFloat($(this).text()));
        });
        datas.push({name : 'question '+i, data: tmp});
        i++;
    });
    return need == 'datas' ? datas : libelle;
}