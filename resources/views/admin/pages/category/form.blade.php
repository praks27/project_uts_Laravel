@extends('admin.layouts.index')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3>{{ $category->id ? 'Form Edit Data' : 'Form Input Data' }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @if ($category->id)
                                <form action="{{ route('category.update', ['category' => $category->id]) }}" method="post">
                                    @method('PUT')
                                @else
                                    <form action="{{ route('category.store') }}" method="POST">
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Name Here" value="{{ $category->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option disabled selected text-muted>--choose status--</option>
                                        <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>in
                                            Active</option>
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="description" cols="10" rows="5">{{ $category->description }}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
