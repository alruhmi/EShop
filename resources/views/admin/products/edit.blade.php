@extends('admin.base',['controller_name'=>'Edit Product'])
@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">Update product</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{route('product.update',['id'=>$product->id])}}" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group row add">
                                <input type="hidden" value="{{$product->id}}" name="id">
                                <label class="control-label col-md-2" for="name">Product name:</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="name" value="{{$product->name}}" required>
                                    <p class="error text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="title">Title:</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="{{$product->title}}" name="title" required>
                                    <p class="error text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="slug">Slug:</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="{{$product->slug}}" name="slug" required>
                                    <p class="error text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="price">Price:</label>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" value="{{$product->price}}" name="price" required>
                                    <p class="error text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="details">Details:</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="{{$product->details}}" name="details" required>
                                    <p class="error text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="description">Description:</label>
                                <div class="col-md-10">
                                    <textarea class="form-control"  name="description" required>{{$product->description}}</textarea>
                                    <p class="error text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="brand">Brand:</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="brand" id="brand">
                                        <option value="{{$selected_brand->id}}">{{$selected_brand->name}}</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="category">Category:</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="category" id="category">
                                        <option value="{{$selected_category->id}}">{{$selected_category->name}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="images">Images:</label>
                                <div class="col-md-10">
                                    <input type="file" name="images[]" id="select-img" class="btn-info" multiple>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Attributes</label>
                                <div class="col-md-4">
                                    <script type="text/javascript" >
                                        var attributes=[];
                                        var attr_values=[];
                                        @foreach($allAttributes as $attribute)
                                            attributes[{{$attribute->id}}]="{{$attribute->name}}";
                                        @endforeach

                                    </script>
                                    <select  class="multi-select form-control" multiple>
                                        @foreach($allAttributes as $attribute)
                                            <option onchange="fillAttributes()"  value="{{$attribute->id}}" @if (in_array($attribute,$attrs))
                                                selected
                                            @endif>{{$attribute->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="button" class="btn btn-sm btn-success" id="select-btn">save</button>
                            </div>
                            <div class="attributes">
                                @foreach ($allAttributes_values as $value)
                                    <script type="text/javascript">
                                        attr_values[{{$value->id}}]={!!$value->value!!} ;
                                    </script>
                                @endforeach
                            @foreach($attrs as $attribute)

                                <div class="form-group" id="attr_{{$attribute->id}}">
                                    <label class="control-label col-md-2">{{$attribute->name}}</label>
                                    <div class="col-md-9">
                                        @php( $values=json_decode($attribute->value))
                                        @foreach($values as $value)
                                            <label for="{{$value}}" class="btn btn-sm btn-warning">
                                                <input type="checkbox" name="attributes[{{$attribute->id}}][]" value="{{$value}}"
                                                @if (!empty($attributes) && isset($attributes[$attribute->id]) && in_array($value,$attributes[$attribute->id]))
                                                     checked
                                                @endif >
                                                <span>{{$value}}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-6">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
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
