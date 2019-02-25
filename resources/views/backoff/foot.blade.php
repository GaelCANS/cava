<!-- Load JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- Load Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Load Lodash -->
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.5/lodash.min.js" ></script>

<!-- Load High Charts -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<!-- Chargement des JS -->
@if (env('APP_ENV') == 'prod')
    <script src="{{ secure_asset('/public/js/bootstrap-datepicker.js' ) }}"></script>
    <script src="{{ secure_asset('/public/js/jquery.ui.min.js' ) }}"></script>
    <script src="{{ secure_asset('/public/js/laravel.js?v=1') }}"></script>
    <script src="{{ secure_asset('/public/js/backoff-app.js?v='.time() ) }}"></script>
    <script src="{{ secure_asset('/public/js/pilotage.js?v='.time() ) }}"></script>
@else
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.min.js' ) }}"></script>
    <script src="{{ asset('js/laravel.js?') }}"></script>
    <script src="{{ asset('js/backoff-app.js?v='.time() ) }}"></script>
    <script src="{{ asset('js/pilotage.js?v='.time() ) }}"></script>
@endif