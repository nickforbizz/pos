@extends('layouts.cms')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"> Product Category </h4>
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
                <a href="{{ route('productCategories.index') }}" class="text-primary"> Product Categories</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Show</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="card-title"> Product Category Details</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ol class="activity-feed">
                                <li class="feed-item feed-item-secondary">
                                    <time class="date">Name</time>
                                    <span class="text"> {{ $productCategory->name }} </span>
                                </li>
                                <li class="feed-item feed-item-success">
                                    <time class="date"> Description </time>
                                    <span class="text"> {{ $productCategory->description }} </span>
                                </li>
                                <li class="feed-item feed-item-danger">
                                    <time class="date"> Status </time>
                                    <span class="text"> {{ ($productCategory->active == 1) ? 'Active' : 'Inactive' }} </span>
                                </li>
                            </ol>
                        </div>

                        <div class="col-md-6">
                            <ol class="activity-feed">
                                <li class="feed-item feed-item-info">
                                    <time class="date"> Created By </time>
                                    <span class="text"> {{ $productCategory->user->name }} </span>
                                </li>
                                <li class="feed-item feed-item-warning">
                                    <time class="date"> Created At </time>
                                    <span class="text"> {{ $productCategory->created_at }} </span>
                                </li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List of Available Products in this Category</h4>
                        @can('create product categories')
                        <a href="{{ route('productCategories.create') }}" class="btn btn-primary btn-round ml-auto">
                            <i class="flaticon-add mr-2"></i>
                            Add Row
                        </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">


                    <div class="table-responsive">
                        @include('cms.helpers.partials.feedback')
                        <table id="tb_productCategories" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Img</th>
                                    <th>Title</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
        $('#tb_productCategories').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('productCategories.show', ['productCategory' => $productCategory]) }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'photo'
                },
                {
                    data: 'title'
                },
                {
                    data: 'created_at',
                },
            ]
        });
        // #tb_productCategories


    });
</script>

@endpush