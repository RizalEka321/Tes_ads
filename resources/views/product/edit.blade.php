@extends('layouts.app')
@section('title', 'Edit Produk')
@section('content')
    <div class="details">
        <div class="content">
            <div class="card_header">
                <h2>Edit </h2>
            </div>
            <form action="{{ Route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="name">Name :</label>
                            <input type="text" name="name" value="{{ $product->name }}"
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
                            <label for="name">Category :</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                @foreach ($category as $c)
                                    <option value="{{ $c->id }}"
                                        {{ $product->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('name')
                                    Nama tidak boleh kosong.
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="description">Description :</label>
                            <input type="text" name="description" value="{{ $product->description }}"
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
                            <input type="text" name="stock" value="{{ $product->stock }}"
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
                            <input type="text" name="price" value="{{ $product->price }}"
                                class="form-control @error('price') is-invalid @enderror" placeholder="Harga">
                            <div class="text-danger">
                                @error('price')
                                    Harga tidak boleh kosong.
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="price">Gambar :</label>
                        <div class="gambar py-2">


                            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                                @foreach ($product_asset as $a)
                                    <div class="col">
                                        <div class="content_img p-3 text-center">
                                            <a href="{{ route('product-asset.destroy', $a->id) }}">
                                                <img src="{{ asset('/storage/product/' . $a->image) }}" alt=""
                                                    height="150px" width="150px">
                                                <div>Hapus</div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-5 ms-2">
                                <!-- Button modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Tambah Gambar
                                </button>
                            </div>
                        </div>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Gambar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product-asset.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="image">Masukkan Gambar</label>
                                <input type="file" name="image" class="form-control">
                                <input type="text" name="product_id" value="{{ $product->id }}" class="form-control"
                                    hidden>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
