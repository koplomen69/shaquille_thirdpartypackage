@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Barang Baru</h1>
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kode_barang">Kode Barang:</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}">
                @error('kode_barang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}">
                @error('nama_barang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="harga_barang">Harga Barang:</label>
                <input type="text" class="form-control" id="harga_barang" name="harga_barang" value="{{ old('harga_barang') }}">
                @error('harga_barang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="deskripsi_barang">Deskripsi Barang:</label>
                <textarea class="form-control" id="deskripsi_barang" name="deskripsi_barang">{{ old('deskripsi_barang') }}</textarea>
                @error('deskripsi_barang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="satuan_id">Satuan Barang:</label>
                <select class="form-control" id="satuan_id" name="satuan_id">
                    @foreach($satuans as $satuan)
                        <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                    @endforeach
                </select>
                @error('satuan_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>




            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection

