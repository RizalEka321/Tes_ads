@extends('layouts.app')
@section('title', 'Kategori')
@section('content')
    <div class="details">
        <div class="content">
            <div class="card_header">
                <h2>Category</h2>
            </div>
            <a href="{{ route('category.add') }}"><button class="btn btn-primary">Add Category</button></a>
            <table class="table table-bordered mt-1">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>Name</th>
                        <th>Jumlah Product</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $c)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->product_count }}</td>
                            <td>
                                <a href="{{ route('category.edit', $c->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('category.destroy', $c->id) }}" class="btn btn-danger btn-sm">
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
