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
                        <a href="{{ route('employee_salaries.index') }}" class="btn btn-primary btn-round ml-auto" >
                            <i class="flaticon-left-arrow-4 mr-2"></i>
                            View Records
                        </a> 
                    </div>
                </div>
                <div class="card-body">

                    <!-- form -->
                    @include('cms.helpers.partials.feedback')
                    <form id="employee_salaries-create" 
                            action="@if(isset($employee_salary->id))  
                            {{ route('employee_salaries.update', ['employee_salary' => $employee_salary->id]) }}
                            @else {{ route('employee_salaries.store' ) }} @endif"  
                            method="post" 
                            enctype="multipart/form-data">

                        @csrf
                        @if(isset($employee_salary->id))
                            @method('PUT')
                            <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        @endif



                        <div class="form-group">
                            <label for="amount" > Amount </label>
                            <input id="amount" type="text" class="form-control " name="amount" value="{{ $employee_salary->amount ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('name') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pay_date"> Pay Date</label>
                            <input id="pay_date" type="date" class="form-control " name="pay_date" value="{{ $employee_salary->pay_date ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('pay_date') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pay_frequency"> Pay Frequency</label>
                            <select name="pay_frequency" id="pay_frequency" class="form-control">
                                <option value="monthly" @if(isset($employee_salary->id)) {{  $employee_salary->pay_frequency =='monthly' ?'selected' : '' }} @endif> Monthly </option>
                                <option value="weekly" @if(isset($employee_salary->id)) {{  $employee_salary->pay_frequency =='weekly' ?'selected' : '' }} @endif> Weekly </option>
                                <option value="bi-weekly" @if(isset($employee_salary->id)) {{  $employee_salary->pay_frequency =='bi-weekly' ?'selected' : '' }} @endif> Bi-Weekly </option>
                            </select>
                            @error('fk_employee') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="employee">Employee</label>
                            <select name="fk_employee" id="fk_employee" class="form-control">
                                @forelse($employees as $employee) 
                                    <option value="{{ $employee->id }}" @if(isset($employee_salary->id)) {{  $employee->id == $employee_salary->fk_employee ? 'selected' : '' }} @endif> {{ $employee->name }} </option>
                                @empty
                                    <option selected disabled> -- No item -- </option> 
                                @endforelse
                            </select>
                            @error('fk_employee') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @if(auth()->user()->hasAnyRole(['superadmin']))
                        <div class="form-group">
                            <label for="tenant">Tenant</label>
                            <select name="fk_tenant" id="fk_tenant" class="form-control">
                                @forelse($tenants as $tenant) 
                                    <option value="{{ $tenant->id }}" @if(isset($employee_salary->id)) {{  $tenant->id == $employee_salary->fk_tenant ? 'selected' : '' }} @endif> {{ $tenant->name }} </option>
                                @empty
                                    <option selected disabled> -- No item -- </option> 
                                @endforelse
                            </select>
                            @error('fk_tenant') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif


                        <div class="card">
                            <div class="form-group">
                                <button class="btn btn-success btn-round btn-block float-right">Submit</button>
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