@extends('layouts.cms')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"> Employee Salary </h4>
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
                <a href="#">Employee Salary</a>
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
                        <a href="{{ route('employee_salaries.index') }}" class="btn btn-primary btn-round ml-auto">
                            <i class="flaticon-left-arrow-4 mr-2"></i>
                            View Records
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <!-- form -->
                    @include('cms.helpers.partials.feedback')
                    <form id="employee_salaries-create" action="@if(isset($employee_salary->id))  
                            {{ route('employee_salaries.update', ['employee_salary' => $employee_salary->id]) }}
                            @else {{ route('employee_salaries.store' ) }} @endif" method="post" enctype="multipart/form-data">

                        @csrf
                        @if(isset($employee_salary->id))
                        @method('PUT')
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        @endif


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="amount"> Amount </label>
                                    <input id="amount" type="number" class="form-control " name="amount" value="{{ $employee_salary->amount ?? '' }}" placeholder="Enter your input" required="true" />
                                    @error('amount') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pay_date"> Pay Date</label>
                                    <input id="pay_date" type="date" class="form-control " name="pay_date" value="@if(isset($employee_salary->id)) {{  date_format($employee_salary->pay_date, 'Y-m-d') ?? ''  }} @endif" placeholder="Enter your input" required="true" />
                                    @error('pay_date') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- .row -->






                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pay_frequency"> Pay Frequency</label>
                                    <select name="pay_frequency" id="pay_frequency" class="form-control" required>
                                        <option value="monthly" @if(isset($employee_salary->id)) {{ $employee_salary->pay_frequency =='monthly' ?'selected' : '' }} @endif> Monthly </option>
                                        <option value="weekly" @if(isset($employee_salary->id)) {{ $employee_salary->pay_frequency =='weekly' ?'selected' : '' }} @endif> Weekly </option>
                                        <option value="bi-weekly" @if(isset($employee_salary->id)) {{ $employee_salary->pay_frequency =='bi-weekly' ?'selected' : '' }} @endif> Bi-Weekly </option>
                                    </select>
                                    @error('fk_employee') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="employee">Employee</label>
                                    <select name="fk_employee" id="fk_employee" class="form-control" required>
                                        @forelse($employees as $employee)
                                        <option value="{{ $employee->id }}" @if(isset($employee_salary->id)) {{ $employee->id == $employee_salary->fk_employee ? 'selected' : '' }} @endif> {{ $employee->name }} </option>
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
                            @if(isset($employee_salary->id))
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="active">Active</label>
                                    <select name="active" id="active" class="form-control form-control">
                                        <option value="1" @if($employee_salary->active == 1) selected @endif> -- Activate -- </option>
                                        <option value="0" @if($employee_salary->active == 0) selected @endif> -- Deactivate -- </option>
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
                                        <option value="{{ $tenant->id }}" @if(isset($employee_salary->id)) {{ $tenant->id == $employee_salary->fk_tenant ? 'selected' : '' }} @endif> {{ $tenant->name }} </option>
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



                        <div class="card">
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

    });
</script>

@endpush