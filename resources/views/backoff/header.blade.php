<div class="logo text-center py-3">

        @if (env('APP_ENV') == 'prod')
            <img src="{{ secure_asset('/public/img/logo-cava.png') }}" width="90%"/>
        @else
            <img src="{{ asset('public/img/logo-cava.png') }}" width="90%"/>
        @endif

</div>