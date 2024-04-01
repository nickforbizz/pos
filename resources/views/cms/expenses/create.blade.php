@extends('layouts.cms')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"> Expenses </h4>
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
                <a href="#">Expenses</a>
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
                        <a href="{{ route('expenses.index') }}" class="btn btn-primary btn-round ml-auto" >
                            <i class="flaticon-left-arrow-4 mr-2"></i>
                            View Records
                        </a> 
                    </div>
                </div>
                <div class="card-body">

                    <!-- form -->
                    @include('cms.helpers.partials.feedback')
                    <form id="expenses-create" 
                            action="@if(isset($expense->id))  
                            {{ route('expenses.update', ['expense' => $expense->id]) }}
                            @else {{ route('expenses.store' ) }} @endif"  
                            method="post" 
                            enctype="multipart/form-data">

                        @csrf
                        @if(isset($expense->id))
                            @method('PUT')
                            <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        @endif



                        <div class="form-group">
                            <label for="category" > Category </label>
                            <input id="category" type="text" class="form-control " name="category" value="{{ $expense->category ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('category') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date"> Date</label>
                            <input id="date" type="date" class="form-control " name="date" value="@if(isset($expense->id)) {{ date_format($expense->date, 'Y-m-d') ?? '' }} @endif" placeholder="Enter your input" required="true" />
                            @error('date') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="amount"> Amount</label>
                            <input id="amount" type="text" class="form-control " name="amount" value="{{ $expense->amount ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('amount') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @if(auth()->user()->hasAnyRole(['superadmin']))
                        <div class="form-group">
                            <label for="tenant">Tenant</label>
                            <select name="fk_tenant" id="fk_tenant" class="form-control form-control">
                                @forelse($tenants as $tenant) 
                                    <option value="{{ $tenant->id }}" @if(isset($expense->id)) {{  $tenant->id == $expense->fk_tenant ? 'selected' : '' }} @endif> {{ $tenant->name }} </option>
                                @empty
                                    <option selected disabled> -- No item -- </option> 
                                @endforelse
                            </select>
                            @error('fk_tenant') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="description" > Description</label>
                            <input id="description" type="text" class="form-control " name="description" value="{{ $expense->description ?? '' }}" placeholder="Enter your input" />
                            @error('description') <span class="text-danger">{{ $message }}</span>
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