@extends('admin.base',['controller_name'=>'Add New Product'])
@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">Add new product</div>
                    <p class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('addProduct') }}"
                              enctype="multipart/form-data">
                            {{--{{ csrf_field() }}--}}
                            <div class="form-group row add">
                                <label class="control-label col-md-2" for="name">Product name:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <input type="hidden"   name="_token" value="{{csrf_token()}}">
                    <p class="error text-center alert alert-danger hidden"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="title">Title:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="title" name="title" required>
                    <p class="error text-center alert alert-danger hidden"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="slug">Slug:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="slug" name="slug" required>
                    <p class="error text-center alert alert-danger hidden"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="price">Price:</label>
                <div class="col-md-3">
                    <input type="number" class="form-control" id="price" name="price" required>
                    <p class="error text-center alert alert-danger hidden"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="details">Details:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="details" name="details" required>
                    <p class="error text-center alert alert-danger hidden"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="description">Description:</label>
                <div class="col-md-9">
                    <textarea class="form-control" id="description" name="description" required></textarea>
                    <p class="error text-center alert alert-danger hidden"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="brand">Brand:</label>
                <div class="col-md-9">
                    <select class="form-control" name="brand" id="brand">
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="category">Category:</label>
                <div class="col-md-9">
                    <select class="form-control" name="category" id="category">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="images">Images:</label>
                <div class="col-md-9">
                    <input type="file" name="images[]" id="select-img" class="btn-info" multiple>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Attributes</label>
                <div class="col-md-4">
                    <script type="text/javascript">
                        var attributes=[];
                        var attr_values=[];
                        @foreach($attributes as $attribute)
                            attributes[{{$attribute->id}}]="{{$attribute->name}}";
                            attr_values[{{$attribute->id}}]={!! $attribute->value !!};
                        @endforeach
                    </script>
                <select  class="multi-select form-control" multiple>
                    {{--<option  disabled selected>Choose attributes</option>--}}
                    @foreach($attributes as $attribute)
                    <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                        @endforeach
                </select>
                </div>
            </div>

            <div class="attributes">
                {{--@foreach($attributes as $attribute)--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label col-md-2">{{$attribute->name}}</label>--}}
                        {{--<div class="col-md-9">--}}
                            {{--@php( $values=json_decode($attribute->value))--}}
                            {{--@foreach($values as $value)--}}
                                {{--<label for="{{$value}}" class="btn btn-sm btn-warning">--}}
                                    {{--<input type="checkbox" name="attributes[{{$attribute->id}}][]" value="{{$value}}">--}}
                                    {{--<span>{{$value}}</span>--}}
                                {{--</label>--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            </div>

            <div class="form-group">
                <div class="col-md-9 col-md-offset-6">
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                </div>
            </div>
            </form>

        </div>
    </div>
    </div>
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