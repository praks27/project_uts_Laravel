@extends('layouts.dashboard')
@section('content')
    <div class="container">
    <h3>{{ $category->id ? 'Form Edit Data' : 'Form Input Data'}}</h3>
    @if ($category->id)
        <form action="{{ route('category.update',['category'=>$category->id]) }}" method="post">
            @method('PUT')
    @else
        <form action="{{ route('category.store') }}" method="POST">
    @endif
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="masukkan nama category" value="{{ $category->name }}">
            </div>
            @error('name') <div class="text-muted">{{$message}}</div> @enderror
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description" cols="10" rows="5">{{ $category->description }}</textarea>
            </div>
            @error('description') <div class="text-muted">{{$message}}</div> @enderror
            <select name="status" id="status" class="form-select">
                    <option value="active" {{ $category->status == 'active' ? "selected" : ""}}>Active</option>
                    <option value="inactive" {{ $category->status == 'inactive' ? "selected" : ""}}>in Active</option>
            </select>
            @error('status') <div class="text-muted">{{$message}}</div> @enderror
            <button type="submit" class="btn btn-outline-success">Submit</button>
        </div>
    </form>
@endsection
