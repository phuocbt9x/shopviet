@extends('admin.layout.main')
@include('admin.layout.form')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12 d-flex flex-row-reverse">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
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
                    <div class="col-12 mb-3 d-flex flex-row-reverse">
                        <a href="{{ route('coupon.index') }}" class="btn btn-sm btn-success"> List coupons</a>
                    </div>
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Coupon update</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('coupon.update', $couponModel->slug) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" id="type"
                                            class="form-control @error('type')  is-invalid @enderror">
                                            <option value="">Choose a type</option>
                                            @foreach ($types as $key => $type)
                                                <option @selected($type == $couponModel->type) value="{{ $type }}">
                                                    {{ $key }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" type="text" value="{{ $couponModel->name }}"
                                            class="form-control @error('name')  is-invalid @enderror" id="name"
                                            placeholder="Enter name">
                                        @error('name')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="value">Value</label>
                                        <input name="value" type="number" value="{{ $couponModel->value }}"
                                            class="form-control @error('value')  is-invalid @enderror" id="value"
                                            min="0" placeholder="Enter value ">
                                        @error('value')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input name="stock" type="number" value="{{ $couponModel->stock }}"
                                            class="form-control @error('stock')  is-invalid @enderror" id="stock"
                                            min="0" placeholder="Enter stock ">
                                        @error('stock')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Time start:</label>

                                        <div class="input-group">
                                            <input name="time_start" type="text" class="form-control"
                                                value="{{ date('d/m/Y', strtotime($couponModel->time_start)) }}"
                                                data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                                data-mask>
                                        </div>
                                        @error('time_start')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                        <label>Time end:</label>

                                        <div class="input-group">
                                            <input name="time_end" type="text" class="form-control"
                                                value="{{ date('d/m/Y', strtotime($couponModel->time_end)) }}"
                                                data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                                data-mask>
                                        </div>
                                        @error('time_end')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <!-- /.input group -->
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input @checked($couponModel->activated) name="activated" class="custom-control-input"
                                            type="checkbox" id="activated" value="1">
                                        <label for="activated" class="custom-control-label">Active</label>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer d-flex flex-row-reverse">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
