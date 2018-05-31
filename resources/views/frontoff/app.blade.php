<!DOCTYPE html>
<html>

@include('frontoff.head')

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('frontoff.header')

            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content body">
            @include('frontoff.flash')

            @yield('content')
        </div>
    </div>

</div>
<!-- ./wrapper -->

@include('frontoff.foot')

</body>
</html>
