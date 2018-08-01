<!DOCTYPE html>
<html>

@include('backoff.head')

<body>
<div class="row">

    <div class="side col-md-1">
        @include('backoff.header')

        @include('backoff.side')
    </div>

            <!-- Content Wrapper. Contains page content -->
    <div class="col-md-11 content-wrapper">
        <div class="content body">
            @include('flash.flash')

            @yield('content')
        </div>
    </div>

</div>
<!-- ./wrapper -->

@include('backoff.foot')

</body>
</html>
