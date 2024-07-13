@extends('layouts.cms')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"> Employee Attendance </h4>
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
                <a href="#">Employee Attendance</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Create</a>
            </li>
        </ul>
    </div>
    <div class="row">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Add|Edit Record</h4>
                        <a href="{{ route('employee_attendance.index') }}" class="btn btn-primary btn-round ml-auto">
                            <i class="flaticon-left-arrow-4 mr-2"></i>
                            View Records
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <!-- form -->
                    @include('cms.helpers.partials.feedback')
                    <form id="employee_attendance-create" action="@if(isset($employee_attendance->id))  
                            {{ route('employee_attendance.update', ['employee_attendance' => $employee_attendance->id]) }}
                            @else {{ route('employee_attendance.store' ) }} @endif" method="post" enctype="multipart/form-data">

                        @csrf
                        @if(isset($employee_attendance->id))
                        @method('PUT')
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        @endif


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="clock_in"> Clock In </label>
                                    <input id="clock_in" type="datetime-local" class="form-control " name="clock_in" value="{{ $employee_attendance->clock_in ?? '' }}" placeholder="Enter your input" required="true" />
                                    @error('clock_in') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="clock_out"> Clock Out </label>
                                    <input id="clock_out" type="datetime-local" class="form-control " name="clock_out" value="{{ $employee_attendance->clock_out ?? '' }}" placeholder="Enter your input" required="true" />
                                    @error('clock_out') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- .row -->




                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="date"> Date</label>
                                    <input id="date" type="date" class="form-control " name="date" value="@if(isset($employee_attendance->id)) {{ date_format($employee_attendance->date, 'Y-m-d') ?? '' }} @endif" placeholder="Enter your input" required="true" />
                                    @error('date') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="employee">Employee</label>
                                    <select name="fk_employee" id="fk_employee" class="form-control">
                                        @forelse($employees as $employee)
                                        <option value="{{ $employee->id }}" @if(isset($employee_attendance->id)) {{ $employee->id == $employee_attendance->fk_employee ? 'selected' : '' }} @endif> {{ $employee->name }} </option>
                                        @empty
                                        <option selected disabled> -- No item -- </option>
                                        @endforelse
                                    </select>
                                    @error('fk_employee') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- .row -->




                        <div class="row">
                            @if(isset($employee_attendance->id))
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="active">Active</label>
                                    <select name="active" id="active" class="form-control form-control">
                                        <option value="1" @if($employee_attendance->active == 1) selected @endif> -- Activate -- </option>
                                        <option value="0" @if($employee_attendance->active == 0) selected @endif> -- Deactivate -- </option>
                                    </select>
                                    @error('active') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyRole(['superadmin']))
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tenant">Tenant</label>
                                    <select name="fk_tenant" id="fk_tenant" class="form-control">
                                        @forelse($tenants as $tenant)
                                        <option value="{{ $tenant->id }}" @if(isset($employee_attendance->id)) {{ $tenant->id == $employee_attendance->fk_tenant ? 'selected' : '' }} @endif> {{ $tenant->name }} </option>
                                        @empty
                                        <option selected disabled> -- No item -- </option>
                                        @endforelse
                                    </select>
                                    @error('fk_tenant') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endif
                        </div>
                        <!-- .row -->



                        <div class="card"> <hr>
                            <div class="form-group">
                                <button class="btn btn-success btn-round btn-block float-right submit-form-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                    <!-- End form -->

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
        // validate, Clock Out to be greater than Clock Out
    });
</script>

@endpush