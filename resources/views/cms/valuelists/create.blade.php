@extends('layouts.cms')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"> Valuelists </h4>
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
                <a href="#">Valuelists</a>
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
                        <a href="{{ route('valuelists.index') }}" class="btn btn-primary btn-round ml-auto" >
                            <i class="flaticon-left-arrow-4 mr-2"></i>
                            View Records
                        </a> 
                    </div>
                </div>
                <div class="card-body">

                    <!-- form -->
                    @include('cms.helpers.partials.feedback')
                    <form id="Valuelists-create" 
                            action="@if(isset($valuelist->id))  
                            {{ route('valuelists.update', ['valuelist' => $valuelist->id]) }}
                            @else {{ route('valuelists.store' ) }} @endif"  
                            method="post" 
                            enctype="multipart/form-data">

                        @csrf
                        @if(isset($valuelist->id))
                            @method('PUT')
                            <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        @endif



                        <div class="form-group">
                            <label for="type" > Type</label>
                            <input id="type" type="text" class="form-control " name="type" value="{{ $valuelist->type ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('type') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="value" > Value </label>
                            <input id="value" type="text" class="form-control " name="value" value="{{ $valuelist->value ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('value') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="index" > Index </label>
                            <input id="index" type="number" min="1" class="form-control " name="index" value="{{ $valuelist->index ?? '' }}" placeholder="Enter your input" required="true" />
                            @error('index') <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @if(isset($valuelist->id))
                        <div class="form-group">
                            <label for="active" > Active </label>
                            <select name="active" class="form-control" id="active">
                                <option value="1" @if($valuelist->active == 1) selected @endif>Yes</option>
                                <option value="0" @if($valuelist->active == 0) selected @endif>No</option>
                            </select>
                            @error('active') <span class="text-danger">{{ $message }}</span>
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