@extends('template.default.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">CRUD Customers Management</h3>
                    </div>
                    <div class="col-sm-4">
                        <button class="create-modal btn btn-primary">Add new customer</button>
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
                                    <th  class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">First name</th>
                                    <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Last name</th>
                                    <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Email</th>
                                    <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Gender</th>
                                    <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Address</th>
                                    <th  class="sorting hidden-xs" tabindex="0"  rowspan="1" colspan="1">Password</th>
                                    <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="2" >Action</th>
                                </tr>
                                </thead>
                                <?php $gender=""; ?>
                                <tbody id="table">
                                @foreach ($customers as $customer)
                                    @if ($customer->gender=="1")
                                        {{$gender="Male"}}
                                    @else
                                        {{$gender="Female"}}
                                    @endif

                                    <tr role="row" class="odd customer{{ $customer->id }}">
                                        <td class="sorting_1">{{ $customer->firstname }} </td>
                                        <td class="hidden-xs">{{ $customer->lastname }}</td>
                                        <td class="hidden-xs">{{ $customer->email }}</td>
                                        <td class="hidden-xs">{{ $gender}}</td>
                                        <td class="hidden-xs">{{ $customer->address }}</td>
                                        <td class="hidden-xs">{{ $customer->password }}</td>
                                        <td>
                                            <a href="#" class="show-modal btn btn-info btn-sm" customer-id="{{$customer->id}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="#" class="edit-modal btn btn-warning btn-sm" customer-id="{{$customer->id}}">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                            <a href="#" class="delete-modal btn btn-danger btn-sm" customer-id="{{$customer->id}}" customer-name="{{$customer->firstname}}">
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
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($customers)}} of {{count($customers)}} entries</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                {{ $customers->links() }}
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
        @include('customers.modal')
    </section>
    </div>

@endsection

@section('title') CM| customers Management @endsection

@section('controller-js')
    <script src="{{ asset("js/customers.js") }}" type="text/javascript"></script>
@endsection