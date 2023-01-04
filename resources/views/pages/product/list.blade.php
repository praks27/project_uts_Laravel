@extends('layouts.dashboard')
@section('content')
    <a href="{{ route('product.create') }}" class="btn btn-success mb-2">Tambah Data</a>
    <form action="{{ route('product.index') }}" method="GET">
        <div class="row g-3 align-items-center pb-2">
            <div class="col-auto">
                <input type="text" id="search" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="search Here" aria-describedby="passwordHelpInline" autocomplete="off">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-outline-success">search</button>
            </div>
        </div>
    </form>
    {{-- untuk menghide dan memunculkan alert --}}
    @if ($message = Session::get('notif'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Price</th>
                <th scope="col">Weight</th>
                <th scope="col">category</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $list)
                <tr>
                    {{-- untuk generate nomer urut otomatis --}}
                    <th scope="row">{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</th>
                    {{-- untuk memanggil data dari database dan di tampilkan --}}
                    <td>{{ $list->title }}</td>
                    <td>{{ $list->description }}</td>
                    <td>
                        @if ($list->status == 'active')
                            <h5><span class="badge bg-success">{{ $list->status }}</span></h5>
                        @elseif ($list->status == 'draft')
                            <h5><span class="badge bg-warning">{{ $list->status }}</span></h5>
                        @else
                            <h5><span class="badge bg-danger">{{ $list->status }}</span></h5>
                        @endif
                    </td>
                    <td>{{ $list->price }}</td>
                    <td>{{ $list->weight }}</td>
                    {{-- ditambahkan name karna untuk memanggil name dari table major yang sebabnya sudah ada belongsto --}}
                    <td>{{ $list->category->name }}</td>
                    <td><img src="/storage/{{ $list->image }}" class="img-thumbnail" width="200px" height="200px"></td>
                    <td>
                        <a href="{{ route('prod
                        uct.edit', ['product' => $list->id]) }}" class="btn btn-warning">Edit</a>
                        {{-- untuk hapus data di table --}}
                        <form action="{{ route('product.destroy', ['product' => $list->id]) }}" class="d-inline"
                            method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-success">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
@endsection
