<!DOCTYPE html>
<html>
@include('template.default.layouts.head')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- Main Header -->
    @include('template.default.layouts.header')
    <!-- Sidebar -->
    @include('template.default.layouts.sidebar')
    <!-- /.content-wrapper -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $controller_name }}
            </h1>
            <ol class="breadcrumb">
                <!-- li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li-->
                <li class="active">{{ $controller_name }}</li>
            </ol>
        </section>
        @yield('action-content')
        <!-- /.content -->
    </div>
    <!-- Footer -->
    @include('template.default.layouts.footer')
    <!-- ./wrapper -->

@include('template.default.js')
    </body>
    </html>
