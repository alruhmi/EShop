@extends('category.base')
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
                        <label class="control-label col-md-4" for="description">Description:</label>
                        <div class="col-md-6">
                            <textarea type="text" class="form-control" id="description" name="description" required></textarea>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="img">Photo path:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="img" name="img" required>
                            <input type="hidden" value="" id="id" >
                            <input type="hidden" name="_token" >
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="row">
                    <p align="center" id="post-info" ></p>
                    <div class="col-sm-5">

                    </div>
                    <div class="col-sm-7">
                        <button class=" category_btn btn btn-primary">Add new Category</button>
                        <button style="display: none" class="delete_btn btn btn-danger" >Delete Category</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->


@endsection