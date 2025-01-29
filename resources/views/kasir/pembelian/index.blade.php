@extends('layouts.kasir')

@section('content')
    <h1>Form Pembelian</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('kasir.pembelian.proses') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="pelanggan_id" class="form-label">Pilih Pelanggan</label>
            <select name="pelanggan_id" id="pelanggan_id" class="form-select" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($pelanggan as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
                @endforeach
            </select>
        </div>

        <div id="produk-wrapper">
            <div class="mb-3 produk-item">
                <label class="form-label">Pilih Produk</label>
                <select name="produk_id[]" class="form-select produk-select" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produk as $p)
                        <option value="{{ $p->id }}" data-harga="{{ $p->harga }}">
                            {{ $p->nama_produk }} - Rp{{ number_format($p->harga, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                <input type="number" name="jumlah[]" class="form-control mt-2 jumlah-input" placeholder="Jumlah" min="1" required>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" id="add-produk">Tambah Produk</button>

        <div class="mb-3 mt-3">
            <h5>Total Harga: <span id="total-harga">Rp 0</span></h5>
        </div>

        <div class="mb-3">
            <label for="total_bayar" class="form-label">Total Bayar</label>
            <input type="number" name="total_bayar" id="total_bayar" class="form-control" placeholder="Masukkan jumlah uang" required>
        </div>

        <button type="submit" class="btn btn-primary">Proses Transaksi</button>
    </form>

    @if (session('error'))
        <div class="alert alert-danger" style="border-left: 5px solid #dc3545; background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 10px; margin-top: 10px;">
            <strong>Peringatan!</strong> {{ session('error') }}
        </div>
    @endif

    <script>
        function updateTotalHarga() {
            let total = 0;
            document.querySelectorAll('.produk-item').forEach(item => {
                const select = item.querySelector('.produk-select');
                const jumlah = item.querySelector('.jumlah-input');
                const harga = select.options[select.selectedIndex].dataset.harga || 0;

                total += (parseInt(jumlah.value) || 0) * parseInt(harga);
            });

            document.getElementById('total-harga').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        document.getElementById('add-produk').addEventListener('click', function () {
            const wrapper = document.getElementById('produk-wrapper');
            const newProduct = wrapper.children[0].cloneNode(true);
            newProduct.querySelector('.jumlah-input').value = '';
            wrapper.appendChild(newProduct);

            // Tambahkan event listener ke elemen baru
            newProduct.querySelector('.produk-select').addEventListener('change', updateTotalHarga);
            newProduct.querySelector('.jumlah-input').addEventListener('input', updateTotalHarga);
        });

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.produk-select, .jumlah-input').forEach(element => {
                element.addEventListener('change', updateTotalHarga);
                element.addEventListener('input', updateTotalHarga);
            });
        });
    </script>
@endsection
