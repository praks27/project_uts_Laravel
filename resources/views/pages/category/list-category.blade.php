@extends('layouts.dashboard')
@section('content')

<table class="table table-striped table-bordered">
    <h3>jurusan {{ $categories->name }} </h3>
    {{-- cara menggunakan count --}}
    <h4>Jumlah Siswa :{{ $categories->products->count() }}</h4>
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Student Name</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($categories->products as $product)
            <tr>
                <th scope="col">{{ $loop->iteration }}</th></th>
                <td>{{ $product->title }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
