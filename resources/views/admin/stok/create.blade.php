@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Stok Barang</h2>
    <form action="{{ route('admin.stok.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="item_id" class="form-label">Nama Barang</label>
            <select name="item_id" id="item_id" class="form-control" required>
                <option value="">Pilih Barang</option>
                @foreach($items as $barang)
                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
            <input type="number" name="jumlah_stok" id="jumlah_stok" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="expired_date" class="form-label">Tanggal Kedaluwarsa</label>
            <input type="date" name="expired_date" id="expired_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="buy_date" class="form-label">Tanggal Pembelian</label>
            <input type="date" name="buy_date" id="buy_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Stok</button>
        <a href="{{ route('admin.stok.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
