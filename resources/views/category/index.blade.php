@extends('template.default.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">List of Category</h3>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>

                </div>
                <div class="form-horizontal">
                    <form method="post" enctype="multipart/form-data" class="form-horizontal" id="add-new-category"
                          role="form">
                        <div class="form-group">
                            <label class="control-label col-md-4" for="ListCateg">Categories list:</label>
                            <div class="col-md-6" id="ListCateg">
                                {{--<select class="form-control" name="ListCateg" id="ListCateg">--}}
                                {{--@foreach($categories as $category)--}}
                                {{--<option value="{{$category->id}}">{{$category->name}}</option>--}}
                                {{--@endforeach--}}
                                {{--</select>--}}
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label class="control-label col-md-4" for="name">Category name:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" name="name" required>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4" for="slug">Slug:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="slug" name="slug" required>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4" for="description">Description:</label>
                            <div class="col-md-6">
                                <textarea type="text" class="form-control" id="description" name="description"
                                          required></textarea>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4" for="image">Image:</label>
                            <div class="col-md-6">
                                <input type="file" name="image" id="select-img" class="btn-info">
                                <input type="hidden" value="" name="id" id="id">
                                <input type="hidden" value="" name="oldImg" id="oldImg">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-5 image-section" style="display: none">

                        </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="row">
                    <p align="center" id="post-info"></p>
                    <div class="col-sm-5">

                    </div>
                    <div class="col-sm-7">
                        <button type="submit" class="btn btn-primary" id="category_btn">Add new Category</button>
                        </form>
                        <button style="display: none" class="delete_btn btn btn-danger">Delete Category</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->


@endsection
@section('js')

@endsection

@section('title') CM| Categories Management @endsection

@section('controller-css')
    <link href="{{ asset('css/categories.css') }}" rel="stylesheet">
@endsection

@section('controller-js')
    <script src="{{ asset("js/category.js") }}" type="text/javascript" ></script>
@endsection