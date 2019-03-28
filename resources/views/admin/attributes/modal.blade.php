{{--add modal--}}
<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Attribute</h4>
            </div>
            <form method="post" id="add-attr">
                {{csrf_field()}}
                <div class="modal-body form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Attribute:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <button type="button" class="btn btn-primary" id="add-input"><i class="glyphicon glyphicon-plus"></i> </button>
                        <button type="button" class="btn btn-danger" id="remove-input"><i class="glyphicon glyphicon-minus"></i> </button>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="values">Value:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control input-id" name="values[]" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" id="add-btn">
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

{{--edit modal--}}
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Selected Attribute</h4>
            </div>
            <form method="post" id="edit-attr">
                {{csrf_field()}}
                <div class="modal-body form-horizontal" id="modal-body">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Attribute:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control edit-name" name="name" required>
                            <input type="hidden"  name="id" id="id">
                        </div>
                        <button type="button" class="btn btn-primary" id="add-input"><i class="glyphicon glyphicon-plus"></i> </button>
                        <button type="button" class="btn btn-danger" id="remove-input"><i class="glyphicon glyphicon-minus"></i> </button>
                    </div>
                    {{--<div class="form-group">--}}
                    {{--<label class="control-label col-sm-2" for="values">Values:</label>--}}
                    {{--<div class="col-sm-7">--}}
                    {{--<input type="text" class="form-control edit-value" name="values[]" required>--}}
                    {{--</div>--}}
                    {{--<button type="button" class="btn btn-primary" id="add-input"><i class="glyphicon glyphicon-plus"></i> </button>--}}
                    {{--<button type="button" class="btn btn-danger" id="remove-input"><i class="glyphicon glyphicon-minus"></i> </button>--}}
                    {{--</div>--}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" id="edit-btn">
                        <span class="glyphicon glyphicon-upload"></span>Update
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


{{--delete modale--}}
<div id="delete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Selected Attribute</h4>
            </div>
            <div class="modal-body">
                <h3>Do you want to delete <span id="attribute-name"></span> attribute?</h3>
                <input type="hidden" name="id" id="delete-id">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" id="delete-btn">
                    <span class="glyphicon glyphicon-trash"></span>Delete
                </button>
                <button class="btn btn-warning" type="button" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>Close
                </button>
            </div>
        </div>
    </div>
</div>