<!-- resources/views/barang/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Barang</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Deskripsi Barang</th>
                    <th>Satuan Barang</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $item)
                    <tr>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->harga_barang }}</td>
                        <td>{{ $item->deskripsi_barang }}</td>
                        <td>{{ $item->satuan ? $item->satuan->nama_satuan : 'Satuan tidak tersedia' }}</td>
                        <td>
                            <a href="{{ route('barang.show', $item->id) }}" class="btn btn-primary">Detail</a>
                            <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Tidak ada data barang.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('barang.create') }}" class="btn btn-success">Tambah Barang</a>
    </div>
@endsection
