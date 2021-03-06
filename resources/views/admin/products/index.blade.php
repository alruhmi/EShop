@extends('admin.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">List of products</h3>
                    </div>
                    <div class="col-sm-4">
                        <a href="{{route('product.create')}}" class="btn btn-primary">Add new product</a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>
                </div>

                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name:" aria-sort="ascending">Product name</th>
                                    <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Title">Title</th>
                                    <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Slug">Slug</th>
                                    <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Price">Price</th>
                                    <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Details">Details</th>
                                    <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Description">Description</th>
                                    <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Brand">Brand</th>
                                    <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Category">Category</th>
                                    <th width="17%" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                                </tr>
                                </thead>
                                <tbody id="table">
                                @foreach ($products as $product)
                                    <tr role="row" class="odd product{{ $product->id }}">
                                        <td class="sorting_1">{{ $product->name }} </td>
                                        <td class="hidden-xs">{{ $product->title }}</td>
                                        <td class="hidden-xs">{{ $product->slug }}</td>
                                        <td class="hidden-xs">{{ $product->price }}</td>
                                        <td class="hidden-xs">{{ $product->details }}</td>
                                        <td class="hidden-xs">{{ $product->description }}</td>
                                        <td class="hidden-xs">{{ $product->brand_name }}</td>
                                        <td class="hidden-xs">{{ $product->category_name }}</td>
                                        <td>
                                            <a href="#" class="show-modal btn btn-info btn-sm" product-id="{{$product->id}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{route('product.edit',['id'=>$product->id])}}" class="btn btn-warning btn-sm" product-id="{{$product->id}}">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                            <a href="#" class="show-images-modal btn btn-success btn-sm" product-id="{{$product->id}}">
                                                <i class="glyphicon glyphicon-picture"></i>
                                            </a>
                                            <a href="#" class="delete-modal btn btn-danger btn-sm" product-id="{{$product->id}}" product-name="{{$product->name}}">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($products)}} of {{count($products)}} entries</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
    <section>
        @include('products.modal')
    </section>
    </div>

@endsection
@section('title')
    PM | Product Management
    @endsection
@section('controller-css')
    <link rel="stylesheet" href="{{asset('css/products.css')}}">
    @endsection
@section('controller-js')
    <script src="{{ asset("js/product.js") }}" type="text/javascript" ></script>
@endsection