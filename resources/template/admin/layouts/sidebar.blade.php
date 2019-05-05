<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name}}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{url('admin\dashboard')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Product Management</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin\product') }}"><i class="fa fa-product-hunt"></i> <span>Products</span></a></li>
                    <li><a href="{{ url('admin\attributes') }}"><i class="fa fa-product-hunt"></i> <span>Attributes</span></a></li>
                    <li><a href="{{ url('admin\productsattr') }}"><i class="fa fa-product-hunt"></i> <span>Product Attributes</span></a></li>
                </ul>
            </li>
            <li><a href="{{ url('admin\category') }}"><i class="fa fa-sitemap"></i><span>Categories</span></a></li>
            <li><a href="{{ url('admin\brand') }}"><i class="fa fa-apple"></i> <span>Brands</span></a></li>
            <li><a href="{{ url('admin\customers') }}"> <i class="far fa-address-card"></i><span>Customers</span></a></li>
            <li><a href="{{ url('admin\news') }}"><i class="far fa-newspaper"></i><span>News</span></a></li>
            <li><a href="{{ url('admin\countries') }}"><i class="fa fa-globe"></i><span>Countries</span></a></li>
            <li><a href="{{ url('admin\state') }}"><i class="far fa-flag"></i><span> States</span></a></li>
            <li><a href="{{ url('admin\city') }}"><i class="fas fa-city"></i><span> City</span></a></li>
            <li><a href="{{ url('admin\slides') }}"><i class="fas fa-image"></i><span> Slides</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>