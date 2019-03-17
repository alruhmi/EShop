<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                {{--<form method="post" enctype="multipart/form-data" class="form-horizontal" id="upload-img">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="container">--}}
                        {{--<label class="control-label col-sm-1">Images:</label>--}}
                        {{--<div class="file-field input-field col-sm-10" >--}}
                            {{--<input type="file" name="image" id="select-img" class="col-sm-4">--}}
                            {{--<input type="submit" value="Upload" class="btn btn-success" id="upload">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
                <form method="post" enctype="multipart/form-data" class="form-horizontal" id="add" role="form">
                    {{ csrf_field() }}
                    <div class="form-group row add">
                        <label class="control-label col-sm-2" for="name">Product name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Enter product's name" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Title:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title"
                                   placeholder="write title her" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="price">Price:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="price" name="price" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="details">Details:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="details" name="details"
                                   placeholder="write some details" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="description">Description:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="description" name="description" required></textarea>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="brand">Brand:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="brand" id="brand">
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="category">Category:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category" id="category">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Images:</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" id="select-img" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input class="btn btn-success" type="submit" value="Save">

                        <button class="btn btn-warning" type="button" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span>Close
                        </button>
                    </div>
                </form>
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
                    <span style="color: #d73925"><b id="product_id"/></span>
                </div>
                <div class="form-group">
                    <label for="">Product name:</label>
                    <span style="color: #d73925"><b id="product_name"/></span>
                </div>
                <div class="form-group">
                    <label for="">Title:</label>
                    <span style="color: #d73925"> <b id="product_title"/></span>
                </div>
                <div class="form-group">
                    <label for="">Price:</label>
                    <span style="color: #d73925"> <b id="product_price"/></span>
                </div>
                <div class="form-group">
                    <label for="">Details:</label>
                    <span style="color: #d73925"> <b id="product_details"/></span>
                </div>
                <div class="form-group">
                    <label for="">Description:</label>
                    <span style="color: #d73925"><b id="product_descr"/></span>
                </div>
                <div class="form-group">
                    <label for="">Brand:</label>
                    <span style="color: #d73925"><b id="product_brand"/></span>
                </div>
                <div class="form-group">
                    <label for="">Category:</label>
                    <span style="color: #d73925"><b id="product_categ"/></span>
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
                        <label class="control-label col-sm-2" for="id">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Pid" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Pname">Product name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Pname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Ptitle">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Ptitle">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Pprice">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Pprice">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Pdetails">Details</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Pdetails">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="country">Description</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="Pdescr"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="brand">Brand:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="brand" id="Pbrand">
                                @foreach($brands as $brand)
                                    <option brand_id="{{$brand->id}}" value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="category">Category:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category" id="Pcategory">
                                @foreach($categories as $category)
                                    <option category_id="{{$category->id}}"
                                            value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
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