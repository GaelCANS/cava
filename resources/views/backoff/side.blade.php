<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="text-center navbar-brand-wrapper">
    <a class="navbar-brand brand-logo mx-auto py-3" href="{{route('blueprint-index')}}">
            @if (env('APP_ENV') == 'prod')
                <img src="{{ secure_asset('/public/img/logo-cava.png') }}"/>
            @else
                <img src="{{ asset('img/logo-cava.png') }}"/>
            @endif
    </a>
    </div>
    <ul class="nav">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('blueprint-index')}}">
                <i class="fas fa-list-alt"></i>Liste des enquêtes
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="{{route('new-blueprint')}}">
                <i class="fas fa-plus-circle"></i>Créer une enquête
            </a>
        </li>
        @if (auth()->user()->superadmin)
            <li class="nav-item ">
                <a class="nav-link" href="{{route('list-admins')}}">
                    <i class="fas fa-user"></i>Utilisateurs
                </a>
            </li>
        @endif

        <li class="nav-item nav-profile">
            <div class="nav-link text-center small-text text-white">

                    <a href="{{route('show-admin' , array('id' => auth()->user()->id))}}">
                        <i class="fas fa-user-cog"></i>@if (auth()->user()){{ auth()->user()->fullname }}@endif

                    </a>

                    <br>
                    <a href="{{URL::to('/')}}/logout">
                        <i class="fa fa-sign-out"></i>Se déconnecter
                    </a>
            </div>
            <img src="{{ asset('img/cans-logo-grey.png') }}" width="100%" class="px-4"/>

        </li>

    </ul>



</nav>

