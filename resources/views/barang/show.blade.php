<!-- resources/views/barang/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Barang</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                <p class="card-text"><strong>Kode Barang:</strong> {{ $barang->kode_barang }}</p>
                <p class="card-text"><strong>Harga Barang:</strong> {{ $barang->harga_barang }}</p>
                <p class="card-text"><strong>Deskripsi Barang:</strong> {{ $barang->deskripsi_barang }}</p>
                <p class="card-text"><strong>Satuan Barang:</strong> {{ $barang->satuan->nama_satuan }}</p>
            </div>
        </div>
        <a href="{{ route('barang.index') }}" class="btn btn-primary mt-3">Kembali ke Daftar Barang</a>
    </div>
@endsection
