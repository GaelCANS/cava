<div class="footer p-4 text-center">
    @if (env('APP_ENV') == 'prod')
        <img src="{{ secure_asset('/public/img/cans-logo-grey.png') }}" alt="Crédit Agricole Normandie-Seine" width="240" />
    @else
        <img src="{{ asset('/img/cans-logo-grey.png') }}" alt="Crédit Agricole Normandie-Seine" width="240" />
    @endif
</div>