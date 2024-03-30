@extends('layouts.cms')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">  Tenants </h4>
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
                <a href="#"> Tenants</a>
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
                        <a href="{{ route('tenants.index') }}" class="btn btn-primary btn-round ml-auto" >
                            <i class="flaticon-left-arrow-4 mr-2"></i>
                            View Records
                        </a> 
                    </div>
                </div>
                <div class="card-body">

                    <!-- form -->
                    @include('cms.helpers.partials.feedback')
                    <form id="tenants-create" 
                            action="@if(isset($tenant->id))  
                            {{ route('tenants.update', ['tenant' => $tenant->id]) }}
                            @else {{ route('tenants.store' ) }} @endif"  
                            method="post" 
                            enctype="multipart/form-data">

                        @csrf
                        @if(isset($tenant->id))
                            @method('PUT')
                            <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        @endif


                        <div class="form-group form-floating-label">
                            @if(isset($tenant->id)) 
                            <label for="domain" class=""> Domain</label>
                            <input id="domain" type="text" class="form-control @error('domain') is-invalid @enderror"  value="{{ $tenant->domain ?? '' }}" readonly disabled />
                            @else
                            <label for="domain" > Domain</label>
                            <input id="domain" type="text" class="form-control  @error('domain') is-invalid @enderror" name="domain"  value="{{ $tenant->domain ?? '' }}" placeholder="Enter your input" required />
                            @endif
                            @error('domain') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group form-floating-label">
                            <label for="name" > Name</label>
                            <input id="name" type="text" class="form-control " name="name" value="{{ $tenant->name ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('name') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group form-floating-label">
                            <label for="email"> Email</label>
                            <input id="email" type="text" class="form-control " name="email" value="{{ $tenant->email ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('email') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                     

                        <div class="card">
                            <div class="form-group form-floating-label">
                                <button class="btn btn-success btn-round float-right">Submit</button>
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