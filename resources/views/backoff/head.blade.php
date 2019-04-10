<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{!!  csrf_token()  !!}" />
    <meta name="url-app" content="{!! $app->make('url')->to('/') !!}" />

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('img/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">

    @if (env('APP_ENV') == 'prod')
        <link href="{{ secure_asset( '/public/css/datepicker.css' , Request::secure()) }}" rel="stylesheet">
        <link href="{{ secure_asset( '/public/css/backoff-app.css' , Request::secure()) }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ secure_asset('/public/css/jquery.ui.min.css' , Request::secure()) }}" rel="stylesheet">
        <link href="{{ secure_asset('/public/theme_modules/mdi/css/materialdesignicons.min.css' , Request::secure()) }}" rel="stylesheet">
        <link href="{{ secure_asset('/public/theme_modules/simple-line-icons/css/simple-line-icons.css' , Request::secure()) }}" rel="stylesheet">
        <link href="{{ secure_asset('/public/theme_modules/flag-icon-css/css/flag-icon.min.css' , Request::secure()) }}" rel="stylesheet">
        <link href="{{ secure_asset('/public/theme_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css' , Request::secure()) }}" rel="stylesheet">
    @else
        <link href="{{ asset( 'css/datepicker.css' , Request::secure()) }}" rel="stylesheet">
        <link href="{{ asset( 'css/backoff-app.css' , Request::secure()) }}?v={{ time() }}" rel="stylesheet"><!-- Sortable -->
        <link href="{{ asset('css/jquery.ui.min.css') }}" rel="stylesheet">

        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('/theme_modules/mdi/css/materialdesignicons.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('/theme_modules/simple-line-icons/css/simple-line-icons.css') }}" />
        <link rel="stylesheet" href="{{ asset('/theme_modules/flag-icon-css/css/flag-icon.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('/theme_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css') }}" />
    @endif

    <link href="https://fonts.googleapis.com/css?family=Dosis:400,500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- endinject -->

    <!-- Calendar -->
    <link rel="stylesheet" href="{{ asset('/theme_modules/fullcalendar/dist/fullcalendar.min.css') }}" />
    <!-- End Calendar -->

    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('/theme_modules/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/theme_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}" />
    <link rel="stylesheet" href="{{ asset('/theme_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}?v={{ time() }}" />
    <link rel="stylesheet" href="{{ asset('/theme_modules/jquery-file-upload/css/uploadfile.css') }}?v={{ time() }}" />
    <link rel="stylesheet" href="{{ asset('/theme_modules/sweetalert2/dist/sweetalert2.min.css') }}?v={{ time() }}" />
    <link rel="stylesheet" href="{{ asset('/theme_modules/summernote/dist/summernote-bs4.css') }}?v={{ time() }}" />


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>