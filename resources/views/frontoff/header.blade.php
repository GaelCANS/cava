<header class="text-center">
    <h1>
        @if (env('APP_ENV') == 'prod')
            <img src="{{ secure_asset('/public/img/logo-cava.png') }}" width="130"/>
        @else
            <img src="{{ asset('/img/logo-cava.png') }}" width="130"/>
        @endif
    </h1>
</header>