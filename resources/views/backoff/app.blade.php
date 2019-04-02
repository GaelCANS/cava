<!DOCTYPE html>
<html>

@include('backoff.head')

<body class="">
<div class="container-scroller">


    <div class="container-fluid page-body-wrapper">
        <div class="row row-offcanvas row-offcanvas-right">
            @include('backoff.side')

            <div class="content-wrapper">
                @include('flash.flash')

                @yield('content')
            </div>
        </div>

    </div>
</div>



@include('backoff.foot')

</body>
</html>
