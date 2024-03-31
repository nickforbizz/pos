@extends('layouts.cms')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"> Employees </h4>
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
                <a href="#">Employees</a>
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
                        <a href="{{ route('employees.index') }}" class="btn btn-primary btn-round ml-auto" >
                            <i class="flaticon-left-arrow-4 mr-2"></i>
                            View Records
                        </a> 
                    </div>
                </div>
                <div class="card-body">

                    <!-- form -->
                    @include('cms.helpers.partials.feedback')
                    <form id="employees-create" 
                            action="@if(isset($employee->id))  
                            {{ route('employees.update', ['employee' => $employee->id]) }}
                            @else {{ route('employees.store' ) }} @endif"  
                            method="post" 
                            enctype="multipart/form-data">

                        @csrf
                        @if(isset($employee->id))
                            @method('PUT')
                            <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        @endif



                        <div class="form-group">
                            <label for="name" > Name</label>
                            <input id="name" type="text" class="form-control " name="name" value="{{ $employee->name ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('name') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email"> Email</label>
                            <input id="email" type="text" class="form-control " name="email" value="{{ $employee->email ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('email') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @if(auth()->user()->hasAnyRole(['superadmin']))
                        <div class="form-group">
                            <label for="tenant">Tenant</label>
                            <select name="fk_tenant" id="fk_tenant" class="form-control form-control">
                                @forelse($tenants as $tenant) 
                                    <option value="{{ $tenant->id }}" @if(isset($employee->id)) {{  $tenant->id == $employee->fk_tenant ? 'selected' : '' }} @endif> {{ $tenant->name }} </option>
                                @empty
                                    <option selected disabled> -- No item -- </option> 
                                @endforelse
                            </select>
                            @error('fk_tenant') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="phone" > Phone</label>
                            <input id="phone" type="text" class="form-control " name="phone" value="{{ $employee->phone ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('phone') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address" > Address</label>
                            <input id="address" type="text" class="form-control " name="address" value="{{ $employee->address ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('address') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                     

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