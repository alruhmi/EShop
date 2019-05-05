@extends('admin.base',['controller_name'=>'Slide management'])
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">Slides management</h3>
                    </div>
                    <div class="col-sm-4">
                        <a href="#" class="create-modal btn btn-primary">Add new slide</a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>
                </div>

                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                   aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-label="position" aria-sort="ascending">Position
                                    </th>
                                    <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-label="title">Title
                                    </th>
                                    <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-label="description">Description
                                    </th>
                                    <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-label="Brand">Active
                                    </th>
                                    <th width="17%" tabindex="0" aria-controls="example2" rowspan="1" colspan="2"
                                        aria-label="Action: activate to sort column ascending">Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="table">
                                @foreach ($slides as $slide)
                                    <tr role="row" class="odd slide{{ $slide->id }}" >
                                        <td class="sorting_1"><input type="hidden" id="pos" name="pos" value="{{ $slide->position }}" slide_id="{{ $slide->id }}">{{ $slide->position }} </td>
                                        <td class="hidden-xs">{{ $slide->title }}</td>
                                        <td class="hidden-xs">{{ $slide->description }}</td>
                                        @if ($slide->active==false)
                                            <td class="hidden-xs"><input slide-id="{{$slide->id}}" id="active-slide" type="checkbox" data-toggle="toggle" value="{{$slide->active}}"
                                                                         data-onstyle="success" data-offstyle="danger" data-size="small"></td>
                                        @else
                                            <td class="hidden-xs"><input slide-id="{{$slide->id}}" id="active-slide" type="checkbox" checked data-toggle="toggle" value="{{$slide->active}}"
                                                                         data-onstyle="success" data-offstyle="danger" data-size="small">
                                            </td>
                                        @endif
                                        <td>
                                            <a href="#" class="edit-modal btn btn-warning btn-sm"
                                               slide-id="{{$slide->id}}">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                            <a href="#" class="show-images-modal btn btn-success btn-sm"
                                               slide-id="{{$slide->id}}">
                                                <i class="glyphicon glyphicon-picture"></i>
                                            </a>
                                            <a href="#" class="delete-modal btn btn-danger btn-sm"
                                               slide-id="{{$slide->id}}">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1
                                to {{count($slides)}} of {{count($slides)}} entries
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                {{ $slides->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
    <section>
        @include('slides.modal')
    </section>
    </div>

@endsection
@section('title') Slides Management @endsection
@section('controller-js')
    <script type="text/javascript" src="{{asset('js/slides.js')}}"></script>
@endsection