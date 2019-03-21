@extends('brand.base')
@section('action-content')
    <!-- Main content -->
    <div class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">List of brands</h3>
                    </div>
                    <div class="col-sm-4">
                        <button style="width: 100px" class="view-btn btn btn-warning">Table view</button>
                    </div>
                </div>
            </div>

            <!-- /.box-header -->
            {{--view table data--}}
            <section class="table-view" hidden>
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-7 col-sm-offset-3">
                            <table  id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Brand name</th>
                                    <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="HiredDate: activate to sort column ascending">Description</th>
                                    <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Photo path</th>
                                    <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                                </tr>
                                </thead>
                                <tbody id="table">
                                @foreach ($brands as $brand)
                                    <tr role="row" class="odd product{{ $brand->id }}">
                                        <td class="sorting_1">{{ $brand->name }} </td>
                                        <td class="hidden-xs">{{ $brand->description }}</td>
                                        <td class="hidden-xs">{{ $brand->img }}</td>
                                        <td>
                                            <input type="checkbox" >
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($brands)}} of {{count($brands)}} entries</div>
                        </div>
                        <div class="col-sm-5">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                {{ $brands->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{--edit view--}}
            <section class="edit-view">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>

                </div>
                <div class="form-horizontal">
                    <form method="post" enctype="multipart/form-data" class="form-horizontal" id="add-edit-brand"
                          role="form">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="ListBrand">Brands list:</label>
                        <div class="col-md-6" id="ListBrand">

                        </div>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="name">Brand name:</label>
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
                        <label class="control-label col-md-4" for="image">Image:</label>
                        <div class="col-md-6">
                            <input type="file" name="image" id="select-img" class="btn-info">
                            <input type="hidden" value="" name="id" id="id">
                            <input type="hidden" value="" name="oldImg" id="oldImg">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                        <div class="col-md-4 col-md-offset-5 image-section" style="display: none"></div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="row">
                    <p align="center" id="post-info" ></p>
                    <div class="col-sm-5">

                    </div>
                    <div class="col-sm-7">
                        <button type="submit" class="btn btn-primary" id="brand_btn">Add new Brand</button>
                        </form>
                        <button style="display: none" class="delete_btn btn btn-danger" >Delete</button>
                    </div>
                </div>
            </div>
            </section>
    </div>
    <!-- /.content -->
    <section>

    </section>
    </div>

@endsection