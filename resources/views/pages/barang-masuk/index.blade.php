@extends('base')
@section('title', 'Barang Masuk')
@section('content')
    <div class="my-3 text-center">
        <h3 class="fw-bold">Data Barang Masuk</h3>
    </div>
    <div class="mt-5">
        @if ($cekBarang)
            <div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
                <strong>{{ $cekBarang }}</strong> Barang Habis.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
            <form action="{{ route('filterDate') }}" method="get" class="d-flex align-items-start mb-3 gap-3">
                <div class="form-group">
                    <label for="startDate" class="form-label">Mulai dari</label>
                    <input type="date" name="startDate" id="startDate" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="endDate" class="form-label">Sampai</label>
                    <input type="date" name="endDate" id="endDate" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary d-block">
                        Cari
                    </button>
                </div>
            </form>
            <div class="d-flex justify-content-end my-3">
                <a href="/printbarang" class="btn btn-success me-3"><i class="bi bi-printer"></i> Print</a>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-plus-circle"></i> Tambah Barang
                </button>
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover result" id="example">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Nomor Seri</th>
                        <th>Kode Barang</th>
                        <th>QTY</th>
                        <th>Origin (Asal Barang)</th>
                        <th>Tanggal Masuk</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barang as $item)
                        <tr class="text-center align-middle" data-created-at={{ $item->created_at }}>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nomorSeri }}</td>
                            <td>{{ $item->kodeBarang }}</td>
                            @php
                                $toDate = \Carbon\Carbon::parse($item->created_at)->format('d-m-Y');
                            @endphp
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->origin }}</td>
                            <td>{{ $toDate }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('barang.update', $item->id) }}" method="POST">
                                            @method('put')
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">Nomor Seri Barang</label>
                                                <input type="text" class="form-control" name="nomorSeri"
                                                    value="{{ $item->nomorSeri }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kode Barang</label>
                                                <input type="text" class="form-control" name="kodeBarang"
                                                    value="{{ $item->kodeBarang }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Quantity</label>
                                                <input type="number" class="form-control" name="qty"
                                                    value="{{ $item->qty }}" min="0">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Origin (Asal Barang)</label>
                                                <input type="text" class="form-control" name="origin"
                                                    value="{{ $item->origin }}">
                                            </div>
                                            <div class="text-end">
                                                <button type="reset" class="btn btn-secondary">Hapus Inputan</button>
                                                <button type="submit" class="btn btn-primary">Perbarui Barang</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Data Barang Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('barang.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nomor Seri Barang</label>
                            <input type="text" class="form-control" name="nomorSeri">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" name="kodeBarang" value="{{ $kodeBarang }}"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="qty" min="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Origin (Asal Barang)</label>
                            <input type="text" class="form-control" name="origin">
                        </div>
                        <div class="text-end">
                            <button type="reset" class="btn btn-secondary">Hapus Inputan</button>
                            <button type="submit" class="btn btn-primary">Tambah Barang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
                modal.show();
            @endif
        });
    </script>
@endsection
