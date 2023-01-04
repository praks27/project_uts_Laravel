@extends('layouts.dashboard')
@section('content')
    <h3>{{ $product->id ? 'Form Edit Data' : 'Form Input Data' }}</h3>
    @if ($product->id)
        <form action="{{ route('product.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
        @else
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="enter your name here"
            value="{{ $product->title }}">
    </div>
    @error('title')
        <div class="text-muted">{{ $message }}</div>
    @enderror
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" class="form-control" id="status">
            <option disabled selected>--choose status--</option>
            <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>active</option>
            <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>inactive</option>
            <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>draft</option>
        </select>
    </div>
    @error('status')
        <div class="text-muted">{{ $message }}</div>
    @enderror
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" id="description" cols="10" rows="5">{{ $product->description }}</textarea>
    </div>
    @error('description')
        <div class="text-muted">{{ $message }}</div>
    @enderror
    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select name="category_id" class="form-control" id="category_id">
            <option selected disabled>--choose category--</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Weight</label>
        <input type="text" class="form-control" id="weight" name="weight" value="{{ $product->weight }}">
    </div>
    @error('weight')
        <div class="text-muted">{{ $message }}</div>
    @enderror
    <div class="mb-3">
        <label for="name" class="form-label">Price</label>
        <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
    </div>
    @error('price')
        <div class="text-muted">{{ $message }}</div>
    @enderror
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" class="form-control" id="image">
        <img src="/storage/{{ $product->image }}" class="img-thumbnail" width="200px" height="200px">
    </div>
    @error('category')
        <div class="text-muted">{{ $message }}</div>
    @enderror
    <button type="submit" class="btn btn-outline-success">Submit</button>
    </form>
@endsection
