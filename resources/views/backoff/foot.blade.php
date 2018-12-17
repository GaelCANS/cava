<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<!-- Chargement des JS -->
@if (env('APP_ENV') == 'prod')
    <script src="{{ secure_asset('/public/js/backoff-app.js?v='.time() ) }}"></script>
@else
    <script src="{{ asset('js/backoff-app.js?v='.time() ) }}"></script>
@endif