<!-- resources/views/barang/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Barang</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="kode_barang" class="form-label">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" required>
            </div>
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
            </div>
            <div class="mb-3">
                <label for="harga_barang" class="form-label">Harga Barang</label>
                <input type="text" class="form-control" id="harga_barang" name="harga_barang" value="{{ old('harga_barang', $barang->harga_barang) }}" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi_barang" class="form-label">Deskripsi Barang</label>
                <textarea class="form-control" id="deskripsi_barang" name="deskripsi_barang">{{ old('deskripsi_barang', $barang->deskripsi_barang) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="satuan_id" class="form-label">Satuan Barang</label>
                <select class="form-select" id="satuan_id" name="satuan_id" required>
                    @foreach($satuans as $satuan)
                        <option value="{{ $satuan->id }}" {{ old('satuan_id', $barang->satuan_id) == $satuan->id ? 'selected' : '' }}>{{ $satuan->nama_satuan }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
