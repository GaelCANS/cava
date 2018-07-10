
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<!--<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>-->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<!-- Chargement des JS -->
@if (env('APP_ENV') == 'prod')
    <script src="{{ secure_asset( '/public/js/frontoff-app.js?v='.time() ) }}"></script>
@else
    <script src="{{ asset( '/js/frontoff-app.js?v='.time() ) }}"></script>
@endif


<script>
    $('input[type=range]').on('input', function(e){
        var min = e.target.min,
                max = e.target.max,
                val = e.target.value;

        $(e.target).css({
            'backgroundSize': (val - min) * 100 / (max - min) + '% 100%'
        });
    }).trigger('input');

    // DOM Ready
    $(function() {
        var el, newPoint, newPlace, offset;

        // Select all range inputs, watch for change
        $("input[type='range']").change(function() {

                    // Cache this for efficiency
                    el = $(this);

                    // Measure width of range input
                    width = el.width();

                    // Figure out placement percentage between left and right of input
                    newPoint = (el.val() - el.attr("min")) / (el.attr("max") - el.attr("min"));

                    // Janky value to get pointer to line up better
                    offset = -1.3;

                    // Prevent bubble from going beyond left or right (unsupported browsers)
                    if (newPoint < 0) { newPlace = 0; }
                    else if (newPoint > 1) { newPlace = width; }
                    else { newPlace = width * newPoint + offset; offset -= newPoint; }

                    // Move bubble
                    el
                            .next("output")
                            .css({
                                left: newPlace,
                                marginLeft: offset + "%"
                            })
                            .text(el.val());
                })
                // Fake a change to position bubble at page load
                .trigger('change');
    });
</script>
<script>
    // Produces width of .barChart
    $(document).ready(function() {
        $('.graph-bar').each(function() {
            var dataWidth = $(this).data('value');
            var dataWidthTotal = dataWidth*20;
            $(this).css("width", dataWidthTotal + "%");
        });
    });


</script>
