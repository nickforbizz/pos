@extends('layouts.cms')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"> Suppliers </h4>
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
                <a href="#">Suppliers</a>
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
                        <a href="{{ route('suppliers.index') }}" class="btn btn-primary btn-round ml-auto">
                            <i class="flaticon-left-arrow-4 mr-2"></i>
                            View Records
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <!-- form -->
                    @include('cms.helpers.partials.feedback')
                    <form id="suppliers-create" action="@if(isset($supplier->id))  
                            {{ route('suppliers.update', ['supplier' => $supplier->id]) }}
                            @else {{ route('suppliers.store' ) }} @endif" method="post" enctype="multipart/form-data">

                        @csrf
                        @if(isset($supplier->id))
                        @method('PUT')
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        @endif


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name"> Name</label>
                                    <input id="name" type="text" class="form-control " name="name" value="{{ $supplier->name ?? '' }}" placeholder="Enter your input" required="true" />
                                    @error('name') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email"> Email</label>
                                    <input id="email" type="text" class="form-control " name="email" value="{{ $supplier->email ?? '' }}" placeholder="Enter your input" required="true" />
                                    @error('email') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- .row -->



                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone"> Phone</label>
                                    <input id="phone" type="text" class="form-control " name="phone" value="{{ $supplier->phone ?? '' }}" placeholder="Enter your input" required="true" />
                                    @error('phone') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="address"> Address</label>
                                    <input id="address" type="text" class="form-control " name="address" value="{{ $supplier->address ?? '' }}" placeholder="Enter your input" required="true" />
                                    @error('address') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- .row -->



                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="contact_person"> Contact Person </label>
                                    <input id="contact_person" type="text" class="form-control " name="contact_person" value="{{ $supplier->contact_person ?? '' }}" placeholder="Enter your input" required="true" />
                                    @error('contact_person') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if(isset($supplier->id))
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="active">Active</label>
                                    <select name="active" id="active" class="form-control form-control">
                                        <option value="1" @if($supplier->active == 1) selected @endif> -- Activate -- </option>
                                        <option value="0" @if($supplier->active == 0) selected @endif> -- Deactivate -- </option>
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
                                    <select name="fk_tenant" id="fk_tenant" class="form-control form-control">
                                        @forelse($tenants as $tenant)
                                        <option value="{{ $tenant->id }}" @if(isset($supplier->id)) {{ $tenant->id == $supplier->fk_tenant ? 'selected' : '' }} @endif> {{ $tenant->name }} </option>
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