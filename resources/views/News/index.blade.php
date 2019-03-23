@extends('template.default.base')
@section('action-content')
    <div class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">Add News</h3>
                    </div>
                </div>
            </div>

            <form method="post" enctype="multipart/form-data" class="form-horizontal" id="news-form">
                <div class="box-body">
                    <div class="row">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="title">Title:</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="description">Description:</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="description">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="body">Body:</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" name="body"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="image">Image:</label>
                                <div class="col-md-7">
                                    <input type="file" class="btn-info" name="image">
                                    <input type="hidden" value="" name="id" id="id">
                                    <input type="hidden" value="" name="oldImg" id="oldImg">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div align="center">
                            <button type="submit" class="btn btn-primary">Add News</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('title')
  NM | News Management
@endsection

@section('controller-js')
    <script src="{{asset('js/news.js')}}" type="text/javascript"></script>
@endsection
