@extends('layouts.kasir')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0"><i class="bi bi-people"></i> Data Pelanggan</h1>
        <a href="{{ route('kasir.member.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Tambah Pelanggan
        </a>
    </div>

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover text-center rounded-3 overflow-hidden table-striped">
                    <thead class="table-secondary text-white">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Tipe Pelanggan</th>
                            <th>Poin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-light">
                        @foreach($member as $p)
                        <tr>
                            <td>{{ $p->nama_pelanggan }}</td>
                            <td>{{ $p->email ?? '-' }}</td>
                            <td>{{ $p->no_hp }}</td>
                            <td>{{ $p->alamat ?? '-' }}</td>
                            <td><span class="badge bg-info text-dark">{{ $p->tipe_pelanggan }}</span></td>
                            <td><span class="badge bg-warning text-dark">{{ $p->poin_membership }}</span></td>
                            <td>
                                <a href="{{ route('kasir.member.edit', $p->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $p->id }}, '{{ $p->nama_pelanggan }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-3">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel"><i class="bi bi-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus <strong id="namaPelanggan"></strong>?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id, nama) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = '{{ route("kasir.member.destroy", "") }}/' + id;
        document.getElementById('namaPelanggan').textContent = nama;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    // Fade out alert otomatis setelah 3 detik
    setTimeout(() => {
        let alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
</script>
@endsection
