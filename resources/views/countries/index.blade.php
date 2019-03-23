@extends('template.default.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">List of Countries</h3>
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
                        <label class="control-label col-md-4" >Countries list:</label>
                        <div class="col-md-6" id="load-countries">
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="code">Country code:</label>
                        <div class="col-md-6">
                            <input type="text" maxlength="3" class="form-control" id="code" name="code" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="name">Country name:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name" name="name" required>
                            <input type="hidden" value="" id="id" >
                            <input type="hidden" name="_token" >
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>

            <!-- /.box-body -->
            <div class="box-footer">
                <div class="row">
                    <p align="center" id="post-info" ></p>
                    <div class="col-sm-5">

                    </div>
                    <div class="col-sm-7">
                        <button class=" country_btn btn btn-primary">Add new Country</button>
                        <button style="display: none" class="delete_btn btn btn-danger glyphicon glyphicon-trash" >Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('title') CM| Countries Management @endsection

@section('controller-js')
    <script src="{{ asset("js/country.js") }}" type="text/javascript"></script>
@endsection