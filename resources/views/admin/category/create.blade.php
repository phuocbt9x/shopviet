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
                            <li class="breadcrumb-item active">Category</li>
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
                        <a href="{{ route('category.index') }}" class="btn btn-sm btn-success"> List category</a>
                    </div>
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Category Info</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" id="category_id"
                                            class="form-control @error('category_id')  is-invalid @enderror">
                                            <option value="">Choose a category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name category</label>
                                        <input name="name" type="text"
                                            class="form-control @error('name')  is-invalid @enderror" id="name"
                                            placeholder="Enter name category">
                                        @error('name')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input name="activated" class="custom-control-input" type="checkbox" id="activated"
                                            value="1">
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
