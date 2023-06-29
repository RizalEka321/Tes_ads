@extends('layouts.app')
@section('title', 'Kategori')
@section('content')
    <div class="details">
        <div class="content">
            <div class="card_header">
                <h2>Product</h2>
            </div>
            <a href="{{ route('product.add') }}"><button class="btn btn-primary">Add Product</button></a>
            <table class="table table-bordered mt-1">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $p)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->category->name }}</td>
                            <td>{{ $p->stock }}</td>
                            <td>{{ $p->price }}</td>
                            <td>
                                <a href="{{ route('product.edit', $p->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('product.destroy', $p->id) }}" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $category->links() }} --}}
        </div>
    </div>
@endsection
