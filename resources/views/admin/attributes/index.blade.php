@extends('admin.base',['controller_name'=>'Attributes'])
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-md-4 col-md-offset-5">
                        <button class="create-modal btn btn-primary"><span class="glyphicon glyphicon-plus"></span>New Attribute</button>
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
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th width="25%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name:" aria-sort="ascending">Attribute</th>
                                    <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Values">Values</th>
                                    <th width="17%" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                                </tr>
                                </thead>
                                <tbody id="table">

                                @foreach ($attributes as $attribute)
                                    <tr role="row" class="odd attribute{{ $attribute->id }}">
                                        <td class="sorting_1">{{ $attribute->name }} </td>
                                        <td class="hidden-xs">| @foreach(json_decode($attribute->value) as $value)({{$value}})   | @endforeach</td>
                                        <td align="center">
                                            <a href="#" class="edit-modal btn btn-warning btn-sm" attribute-id="{{$attribute->id}}">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                            <a href="#" class="delete-modal btn btn-danger btn-sm" attribute-id="{{$attribute->id}}" attribute-name="{{$attribute->name}}">
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
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($attributes)}} of {{count($attributes)}} entries</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                {{ $attributes->links() }}
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
        @include('attributes.modal')
    </section>
@endsection

@section('title')
    Attributes
@endsection

@section('controller-js')
    <script src="{{asset('js/attribute.js')}}" type="text/javascript"></script>
@endsection

