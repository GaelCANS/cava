$(function() {

    // Moyenne des réponses
    Highcharts.chart('graph', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Evolution des réponses'
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