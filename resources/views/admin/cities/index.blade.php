@extends('admin.base',['controller_name'=>'City Management'])
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">City Management</h3>
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
                        <label class="control-label col-md-4">Cities List:</label>
                        <div class="col-md-6" id="city-list">

                        </div>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <label class="control-label col-md-4">State:</label>
                        <div class="col-md-6" id="state-list">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">City name:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name">
                            <input type="hidden" value=""  id="id">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </div>
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
                        <button type="submit" class="btn btn-primary" id="city_btn">Add new City</button>
                        </form>
                        <button style="display: none" class="delete_btn btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->


@endsection
@section('js')

@endsection

@section('title') Cities CURD @endsection

{{--@section('controller-css')--}}

{{--@endsection--}}

@section('controller-js')
    <script src="{{ asset("js/city.js") }}" type="text/javascript" ></script>
@endsection