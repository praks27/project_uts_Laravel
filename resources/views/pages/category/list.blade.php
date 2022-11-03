@extends('layouts.dashboard')
@section('content')

<a href="{{ route('category.create') }}" class="btn btn-success mb-2">Tambah Data</a>
{{-- untuk menghide dan memunculkan alert --}}
@if ( $message = Session::get('notif'))
    <div class="alert alert-success" role="alert">
        {{$message}}
    </div>
@endif

<table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($data as $list)
        <tr>
            {{-- untuk generate nomer urut otomatis --}}
            <th scope="row">{{ $loop->iteration }}</th>
            {{-- untuk memanggil data dari database dan di tampilkan --}}
            <td>{{ $list->name }}</td>
            <td>{{ $list->description }}</td>
            <td>
                @if ($list->status == 'active')
                    <h5><span class="badge bg-success">Active</span></h5>
                @else
                    <h5><span class="badge bg-warning">in Active</span></h5>
                @endif
            </td>
            <td>
                <a href="{{route('category.show',['category'=>$list->id]) }}" class="btn btn-outline-success">Product</a>
                <a href="{{route('category.edit',['category'=>$list->id]) }}" class="btn btn-warning">Edit</a>
                {{-- untuk hapus data di table --}}
                <form action="{{route('category.destroy',['category'=>$list->id])}}" class="d-inline" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
{{ $data->withQueryString()->links() }}
@endsection
