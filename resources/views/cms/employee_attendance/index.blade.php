@extends('layouts.cms')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"> Employees Attendance </h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"> Employees Attendance</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Index</a>
            </li>
        </ul>
    </div>
    <div class="row">
   

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List of Available Record(s)</h4>
                        @can('create employee attendance')
                        <a href="{{ route('employee_attendance.create') }}" class="btn btn-primary btn-round ml-auto" >
                            <i class="flaticon-add mr-2"></i>
                            Add Row
                        </a> 
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                   

                    <div class="table-responsive">
                        @include('cms.helpers.partials.feedback')
                        <table id="tb_employee_attendance" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Employee</th>
                                    <th> Clock In </th>
                                    <th> Clock Out </th>
                                    <th> Date </th>
                                    <th> Active </th>
                                    <th> Created At </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .page-inner -->

@endsection


@push('scripts')


<script>
    $(document).ready(function() {
        $('#tb_employee_attendance').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employee_attendance.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'employee'
                },
                {
                    data: 'clock_in'
                },
                {
                    data: 'clock_out'
                },
                {
                    data: 'date'
                },
                {
                    data: 'active'
                },					
                {
                    data: 'created_at',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        // #tb_employees

       
    });


    
</script>

@endpush