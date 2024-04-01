@extends('layouts.cms')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"> Orders </h4>
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
                <a href="#">Orders</a>
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
                        <a href="{{ route('orders.index') }}" class="btn btn-primary btn-round ml-auto" >
                            <i class="flaticon-left-arrow-4 mr-2"></i>
                            View Records
                        </a> 
                    </div>
                </div>
                <div class="card-body">

                    <!-- form -->
                    @include('cms.helpers.partials.feedback')
                    <form id="orders-create" 
                            action="@if(isset($order->id))  
                            {{ route('orders.update', ['order' => $order->id]) }}
                            @else {{ route('orders.store' ) }} @endif"  
                            method="post" 
                            enctype="multipart/form-data">

                        @csrf
                        @if(isset($order->id))
                            @method('PUT')
                            <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        @endif



                        <div class="form-group">
                            <label for="order_date"> Order Date</label> 
                            <input id="order_date" type="date" class="form-control " name="order_date" value="{{ date_format($order->order_date, 'Y-m-d') ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('order_date') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="total_amount"> Total Amount </label> 
                            <input id="total_amount" type="text" class="form-control " name="total_amount" value="{{ $order->total_amount ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('order_date') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="employee">Employee</label>
                            <select name="fk_employee" id="fk_employee" class="form-control">
                                @forelse($employees as $employee) 
                                    <option value="{{ $employee->id }}" @if(isset($order->id)) {{  $employee->id == $order->fk_employee ? 'selected' : '' }} @endif> {{ $employee->name }} </option>
                                @empty
                                    <option selected disabled> -- No item -- </option> 
                                @endforelse
                            </select>
                            @error('fk_employee') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="customer"> Customer </label>
                            <select name="fk_customer" id="fk_customer" class="form-control">
                                @forelse($customers as $customer) 
                                    <option value="{{ $customer->id }}" @if(isset($order->id)) {{  $customer->id == $order->fk_customer ? 'selected' : '' }} @endif> {{ $customer->name }} </option>
                                @empty
                                    <option selected disabled> -- No item -- </option> 
                                @endforelse
                            </select>
                            @error('fk_customer') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @if(auth()->user()->hasAnyRole(['superadmin']))
                        <div class="form-group">
                            <label for="tenant">Tenant</label>
                            <select name="fk_tenant" id="fk_tenant" class="form-control">
                                @forelse($tenants as $tenant) 
                                    <option value="{{ $tenant->id }}" @if(isset($order->id)) {{  $tenant->id == $order->fk_tenant ? 'selected' : '' }} @endif> {{ $tenant->name }} </option>
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