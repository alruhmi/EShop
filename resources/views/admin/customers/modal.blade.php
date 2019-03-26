<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group row add">
                        <label class="control-label col-sm-2" for="firstname">First name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                            <p class="error text-center alert  hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="lastname">Last name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                            <p class="error text-center danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="details">Gender:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="gender" id="gender">
                                <option gender="Male" value="1">Male</option>
                                <option gender="Female" value="0">Female</option>
                            </select>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="address">Address:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address" name="address" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="password">Password:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password" name="password" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="img">Picture:</label>
                        <div class="col-sm-10">
                            <input type="file" class="btn-info" id="img" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="add">
                    <span class="glyphicon glyphicon-plus"></span>Save
                </button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remobe"></span>Close
                </button>
            </div>
        </div>
    </div>
</div>
{{-- modal form show product --}}
<div id="show" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">ID:</label>
                    <span style="color: #d73925"><b id="customer-id"/></span>
                </div>
                <div class="form-group">
                    <label for="">First name:</label>
                    <span style="color: #d73925"><b id="Fname"/></span>
                </div>
                <div class="form-group">
                    <label for="">Last name:</label>
                    <span style="color: #d73925"> <b id="Lname"/></span>
                </div>
                <div class="form-group">
                    <label for="">Email:</label>
                    <span style="color: #d73925"> <b id="email-show"/></span>
                </div>
                <div class="form-group">
                    <label for="">Gender:</label>
                    <span style="color: #d73925"> <b id="gender-show"/></span>
                </div>
                <div class="form-group">
                    <label for="">Address:</label>
                    <span style="color: #d73925"><b id="address-show"/></span>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modal form edit and delete product --}}
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="id">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="Fname">First name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Fname-edit">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="Lname">Last name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Lname-edit">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="Email">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email-edit">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="gender">Gender</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="gender" id="gender-edit">
                                <option value="1">Male</option>
                                <option value="0">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="address">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address-edit">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="password">Password:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password-edit">
                        </div>
                    </div>
                </form>
                {{-- Form Delete user --}}
                <div class="deleteContent">
                    Are you sure want to delete product <span style="color: red" class="name"></span>?
                    <span class="hidden id"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn actionBtn" data-dismiss="modal">
                    <span id="footer_action_button" class="glyphicon"></span>
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="glyphicon glyphicon"></span>Close
                </button>
            </div>
        </div>
    </div>
</div>