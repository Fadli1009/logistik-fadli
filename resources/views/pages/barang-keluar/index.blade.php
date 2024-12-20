@extends('base')
@section('title', 'Barang')
@section('content')

    <div class="my-3 text-center">
        <h3 class="fw-bold">Data Barang Keluar</h3>
    </div>
    <div class="mt-5">
        <div class="d-flex justify-content-end mb-3">
            <a href="/print" class="btn btn-success me-3"><i class="bi bi-printer"></i> Print</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-plus-circle"></i> Barang Keluar
            </button>
        </div>
        <div class="table-responsive">

            <table class="table table-striped table-hover" id="example">
                <thead class="table-primary text-center">
                    <tr class="text-center align-middle">
                        <th>No</th>
                        <th>Nomor Seri</th>
                        <th>Kode Barang</th>
                        <th>QTY</th>
                        <th>Destination (Tujuan Barang)</th>
                        <th>Tanggal Keluar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataBarangKeluar as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->barang->nomorSeri }}</td>
                            <td>{{ $item->barang->kodeBarang }}</td>
                            @php
                                $toDate = \Carbon\Carbon::parse($item->created_at)->format('d-m-Y');
                            @endphp
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->destination }}</td>
                            <td>{{ $toDate }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning edit-button" id="edit"
                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"
                                    data-id="{{ $item->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit 
                                </button>
                                <form action="{{ route('barangKeluar.destroy', $item->id) }}" method="POST"
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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Keluar Barang</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('barangKeluar.update', $item->id) }}" method="POST">
                                            @method('put')
                                            @csrf
                                            <div class="mb-3">
                                                <select class="form-select select" aria-label="Default select example"
                                                    name="id_barang">
                                                    <option selected>Pilih Barang</option>
                                                    @foreach ($barang as $items)
                                                        <option {{ $items->id == $item->id_barang ? 'selected' : '' }}
                                                            value="{{ $items->id }}">
                                                            {{ $items->nomorSeri }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- <div class="mb-3">
                                                <label for="" class="form-lable">Nomor Seri Barang</label>
                                                <input type="hidden" id="idBarang" name="idBarang">
                                                <input type="text" class="form-control nomorSeri" id=""
                                                    name="nomorSeri" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-lable">Kode Barang</label>
                                                <input type="text" class="form-control kodeBarang"
                                                    id=""name="kodeBarang" readonly value="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-lable">Quantity Barang Masuk</label>
                                                <input type="number" min="0" class="form-control qty" id=""
                                                    name="stokBarang" readonly>
                                            </div> --}}
                                            <div class="mb-3">
                                                <input type="hidden" name="idBarang" id="idBarang">
                                                <label for="" class="form-lable">Quantity</label>
                                                <input type="number" min="0" class="form-control" name="qty"
                                                    value="{{ $item->qty }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-lable">Destination (Tujuan Barang)</label>
                                                <input type="text" min="0" class="form-control" name="destination"
                                                    value="{{ $item->destination }}">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        @if ($errors->any())
            @foreach ($errors->all() as $item)
                @php
                    toastr()->warning($item);
                @endphp
            @endforeach
        @endif
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Barang yang akan dikeluarkan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('barangKeluar.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select class="form-select select" aria-label="Default select example" id=""
                                name="id_barang">
                                <option selected>Pilih Barang</option>
                                @foreach ($barang as $item)
                                    <option value="{{ $item->id }}">{{ $item->nomorSeri }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Nomor Seri Barang</label>
                            <input type="hidden" class="idbrg" name="id_barang">
                            <input type="text" class="form-control nomorSeri" id="" name="nomorSeri"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Kode Barang</label>
                            <input type="text" class="form-control kodeBarang" id=""name="kodeBarang"
                                readonly value="">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Quantity Barang Masuk</label>
                            <input type="number" min="0" class="form-control qty" id=""
                                name="stokBarang" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Quantity Barang Barang Keluar</label>
                            <input type="number" min="0" class="form-control" value="{{ old('qty') }}"
                                name="qty">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Destination (Tujuan Barang)</label>
                            <input type="text" min="0" class="form-control" name="destination"
                                value="{{ old('destination') }}">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Hapus Inputan</button>
                    <button type="submit" class="btn btn-primary">Simpan Barang Keluar</button>
                </div>
                </form>
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
        $(document).ready(function() {
            $('.select').on('change', function() {
                var selected = $(this).val()
                $.ajax({
                    url: "{{ route('getById') }}",
                    method: "POST",
                    data: {
                        id_barang: selected,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(callback) {
                        console.log(callback.data.id);
                        $('.idbrg').val(callback.data.id)
                        $('.nomorSeri').val(callback.data.nomorSeri)
                        $('.qty').val(callback.data.qty)
                        $('.kodeBarang').val(callback.data.kodeBarang)
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('terjadi kesalahan')
                    }
                })

            });
            $('.edit-button').on('click', function() {
                var id = $(this).data('id')
                $.ajax({
                    url: "{{ route('getBarangKeluar') }}",
                    method: "POST",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(callback) {
                        console.log(callback.data.id_barang);
                        $('#idBarang').val(callback.data.id_barang)
                        // $('.idbrg').val(callback.data.id)
                        // $('.nomorSeri').val(callback.data.nomorSeri)
                        // $('.qty').val(callback.data.qty)
                        // $('.kodeBarang').val(callback.data.kodeBarang)
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('terjadi kesalahan')
                    }
                })

            })
        });
    </script>
@endsection
