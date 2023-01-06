@extends('admin.layout.main')
@include('admin.layout.table')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Coupons</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Coupons</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-row-reverse">
                                <a href="{{ route('coupon.create') }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus-square"></i>
                                    <span class="ml-1">Create new</span>
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="dataTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Code</th>
                                            <th>Type</th>
                                            <th>Value</th>
                                            <th>Stock</th>
                                            <th>Time start</th>
                                            <th>Time end</th>
                                            <th>Status</th>
                                            <th style="width:15%">Action(s)</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('script')
    <script>
        let col = [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'slug',
                name: 'slug'
            },
            {
                data: 'code',
                name: 'code'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'value',
                name: 'value'
            },
            {
                data: 'stock',
                name: 'stock'
            },
            {
                data: 'time_start',
                name: 'time_start'
            },
            {
                data: 'time_end',
                name: 'time_end'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action'
            }
        ];
        renderTable('{!! route('coupon.index') !!}', col)
    </script>
@endpush
