@extends('layouts.cms')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"> Products </h4>
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
                <a href="#">Products</a>
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
                        <h4 class="card-title">Add Record</h4>
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-round ml-auto">
                            <i class="flaticon-left-arrow-4 mr-2"></i>
                            View Records
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <!-- form -->
                    @include('cms.helpers.partials.feedback')
                    <form id="products-create" action="@if(isset($product->id))  
                            {{ route('products.update', ['product' => $product->id]) }}
                            @else {{ route('products.store' ) }} @endif" method="post" enctype="multipart/form-data">

                        @csrf
                        @if(isset($product->id))
                        @method('PUT')
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        @endif

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input id="title" type="text" class="form-control" name="title" placeholder="Enter title ..." value="{{ old('title', $product->title ?? '')  }}" />
                                    @error('title') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="make">Make</label>
                                    <select name="make" id="make" class="form-control">
                                        @foreach(App\Http\Controllers\cms\ValuelistController::getValuesByType('makes') as $make)
                                        <option value="{{ $make->value }}" @if(isset($product->id)) {{ $make->value == $product->make ? 'selected' : '' }} @endif> {{ $make->value }} </option>
                                        @endforeach
                                    </select>
                                    @error('make') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- .row -->





                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cost_price">Cost Price</label>
                                    <input id="cost_price" type="text" class="form-control" name="cost_price" placeholder="Enter cost_price ..." value="{{ old('cost_price', $product->cost_price ?? '')  }}" />
                                    @error('cost_price') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="selling_price">Selling Price</label>
                                    <input id="selling_price" type="text" class="form-control" name="selling_price" placeholder="Enter selling_price ..." value="{{ old('selling_price', $product->selling_price ?? '')  }}" />
                                    @error('selling_price') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- .row -->





                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input id="quantity" type="number" class="form-control" name="quantity" placeholder="Enter quantity ..." value="{{ old('quantity', $product->quantity ?? '')  }}" />
                                    @error('quantity') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="color"> Color </label>
                                    <input id="color" type="color" class="form-control" name="color" placeholder="Enter color ..." value="{{ old('color', $product->color ?? '')  }}" />
                                    @error('color') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- .row -->





                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="label"> Label </label>
                                    <input id="label" type="text" class="form-control" name="label" placeholder="Enter label ..." value="{{ old('label', $product->label ?? '')  }}" />
                                    @error('label') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="size"> Size </label>
                                    <select name="size" id="size" class="form-control">
                                        <option value="s" @if(isset($product->id)) {{ $product->size == 's' ? 'selected' : '' }} @endif> Small </option>
                                        <option value="m" @if(isset($product->id)) {{ $product->size == 'm' ? 'selected' : '' }} @endif> Middle </option>
                                        <option value="l" @if(isset($product->id)) {{ $product->size == 'l' ? 'selected' : '' }} @endif> Large </option>
                                        <option value="xl" @if(isset($product->id)) {{ $product->size == 'xl' ? 'selected' : '' }} @endif> XLarge </option>
                                    </select>
                                    @error('make') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- .row -->




                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="product_category" class="form-control">
                                        @forelse($product_categories as $category)
                                        <option value="{{ $category->id }}" @if(isset($product->id)) {{ $category->id == $product->category_id ? 'selected' : '' }} @endif> {{ $category->name }} </option>
                                        @empty
                                        <option selected disabled> -- No item -- </option>
                                        @endforelse
                                    </select>
                                    @error('category_id') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control Xtiny_textarea" placeholder="Enter description ...">{{ old('description', $product->description ?? '') }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- .row -->





                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group form-floating-label">
                                    <label for="featuredimg" class=""> Photo </label>
                                    <input id="featuredimg" type="file" class="form-control input-border-bottom" name="featuredimg" />
                                    @if (isset($product->photo))
                                    <img id="blah" src="{{ asset('storage/'.$product->photo) }}" alt="current image" height="100px" />
                                    @else
                                    <img id="blah" src="#" alt="no image" height="100px" />
                                    @endif
                                    @error('photo') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if(isset($product->id))
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="active">Active</label>
                                    <select name="active" id="active" class="form-control form-control">
                                        <option value="1" @if($product->active == 1) selected @endif> -- Activate -- </option>
                                        <option value="0" @if($product->active == 0) selected @endif> -- Deactivate -- </option>
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
                                        <option value="{{ $tenant->id }}" @if(isset($product->id)) {{ $tenant->id == $product->fk_tenant ? 'selected' : '' }} @endif> {{ $tenant->name }} </option>
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


                </div>

                <div class="card">
                    <div class="form-group form-floating-label">
                        <button class="btn btn-success btn-round float-right submit-form-btn">Submit</button>
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
<!-- Tiny MCE -->
<script defer src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $(document).ready(function() {
        // tinymce.init
        tinymce.init({
            selector: '.tiny_textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });

        $("#featuredimg").change(function() {
            readURL(this);
        });

        $('#createallcb').change(function() {
            $('.perm_check').prop('checked', $(this).prop('checked'));
        });
    });
</script>

@endpush