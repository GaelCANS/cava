<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="">

                        <div class="logo text-center py-3">

                                @if (env('APP_ENV') == 'prod')
                                        <img src="{{ secure_asset('/public/img/logo-cava.png') }}"/>
                                @else
                                        <img src="{{ asset('img/logo-cava.png') }}"/>
                                @endif

                        </div>


                </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
                <button class="d-none navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">

                        <li class="nav-item dropdown ml-2">
                                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown" >

                                        <i class="icon-arrow-down mx-0"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                        <a class="dropdown-item preview-item" href="{{route('show-admin' , array('id' => auth()->user()->id))}}">

                                                <div class="preview-thumbnail">
                                                        <div class="preview-icon">
                                                                <i class="icon-settings mx-0"></i>
                                                        </div>
                                                </div>
                                                <div class="preview-item-content">
                                                        <span class="preview-subject font-weight-medium">Mon compte</span>
                                                </div>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item preview-item" href="{{URL::to('/')}}/logout">
                                                <div class="preview-thumbnail">
                                                        <div class="preview-icon">
                                                                <i class="icon-logout mx-0"></i>
                                                        </div>
                                                </div>
                                                <div class="preview-item-content">
                                                        <span class="preview-subject font-weight-medium">Se déconnecter</span>
                                                </div>
                                        </a>
                                </div>
                        </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas" >
                        <span class="icon-menu"></span>
                </button>
        </div>
</nav>
