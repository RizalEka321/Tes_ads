@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('content')
    <div class="details">
        <div class="content">
            <div class="card_header">
                <h2>Add Product</h2>
            </div>
            <form action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="name">Name :</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Nama">
                            <div class="text-danger">
                                @error('name')
                                    Nama tidak boleh kosong.
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="category_id">Name :</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="#">-- Pilih Kategori --</option>
                                @foreach ($category as $c)
                                    <option value="{{ $c->id }}">- {{ $c->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('category_id')
                                    Kategori tidak boleh kosong.
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="description">Description :</label>
                            <input type="text" name="description" value="{{ old('description') }}"
                                class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi">
                            <div class="text-danger">
                                @error('description')
                                    Deskripsi tidak boleh kosong.
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="stock">Stock :</label>
                            <input type="text" name="stock" value="{{ old('stock') }}"
                                class="form-control @error('stock') is-invalid @enderror" placeholder="Stok">
                            <div class="text-danger">
                                @error('stock')
                                    Stock tidak boleh kosong.
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="price">Price :</label>
                            <input type="text" name="price" value="{{ old('price') }}"
                                class="form-control @error('price') is-invalid @enderror" placeholder="Harga">
                            <div class="text-danger">
                                @error('price')
                                    Harga tidak boleh kosong.
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route('product') }}" type="button" class="btn btn-secondary"><i
                            class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i>
                        &nbsp;
                        Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
