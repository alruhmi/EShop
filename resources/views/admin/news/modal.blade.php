{{--add news modall--}}
<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" class="form-horizontal" id="add-news" role="form">
                    <div class="form-group">
                        <label class="control-label col-md-2" for="title">Title:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="description">Description:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="description">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="body">Body:</label>
                        <div class="col-md-10">
                            <textarea style="height: 270px" class="form-control" name="body"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="image">Image:</label>
                        <div class="col-md-10">
                            <input type="file" class="btn-info" name="image">
                            <input type="hidden" value="" name="id" id="id">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="active">Active:</label>
                        <div class="col-md-10">
                            <input type="hidden" name="active" value="0" id="new-active">
                            <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                 id="active"  data-size="small">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">
                            <span class="glyphicon glyphicon-plus"></span>Add
                        </button>

                        <button class="btn btn-warning" type="button" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span>Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal form show News --}}
<div id="show" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Title:</label>
                    <span style="color: #d73925"> <b id="news-title"/></span>
                </div>
                <div class="form-group">
                    <label for="">Description:</label>
                    <span style="color: #d73925"><b id="news-descr"/></span>
                </div>
                <div class="form-group">
                    <label for="">body:</label>
                    <span style="color: #d73925"><b id="news-body"/></span>
                </div>
            </div>
        </div>
    </div>
</div>

{{--delete modal--}}
<div id="delete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p>Are you sure do you really want to delete this News?</p>
                <input type="hidden" id="delete-id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="delete-btn" data-dismiss="modal">
                    <span class="glyphicon glyphicon-trash"></span>Delete
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>Close
                </button>
            </div>
        </div>
    </div>
</div>

{{--edit modal--}}
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="update-form" role="modal">
                    <input type="hidden" name="id" class="form-control" id="edit-id">
                    <input type="hidden" name="_token" class="form-control" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="edit-title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="description">Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="description" class="form-control" id="edit-descr">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="body">Body</label>
                        <div class="col-sm-10">
                            <textarea name="body" class="form-control" id="edit-body"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-check">Update</span>
                        </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>Close
                </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

