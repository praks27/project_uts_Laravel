@extends('admin.layouts.index')
@section('content')
    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <h3>Category : {{ $categories->name }} </h3>
                    {{-- cara menggunakan count --}}
                    <h4>Jumlah Product :{{ $categories->products->count() }}</h4>
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Products Name </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories->products as $product)
                            <tr>
                                <th scope="col">{{ $loop->iteration }}</th>
                                </th>
                                <td>{{ $product->title }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
@endsection
