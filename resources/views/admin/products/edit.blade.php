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
