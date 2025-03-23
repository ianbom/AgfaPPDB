@extends('web.admin.layouts.app')
@section('content')


<div class="page-heading">
    @if(session('success'))
    @include('web.admin.alert.success_alert')
    @endif

    @if(session('error'))
    @include('web.admin.alert.error_alert')
    @endif

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Seleksi Siswa</h3>
                <p class="text-subtitle text-muted">Manajemen data seleksi ssiwa</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Seleksi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <form method="POST" action="{{ route('admin.bulkUpdateSeleksi') }}">
            @csrf
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar Seleksi</h4>
                <div class="d-flex gap-2 align-items-center">
                    <select name="status" class="form-select form-select-sm" style="width: 140px;" required>
                        <option value="">Pilih Status</option>
                        <option value="verifikasi">Verifikasi</option>
                        <option value="lulus">Lulus</option>
                        <option value="gagal">Gagal</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-save me-1"></i> Update
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table1">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center">
                                    <input type="checkbox" id="select-all">
                                </th>
                                <th>Nama</th>
                                <th>Data Berkas</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($seleksi as $item)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="selected_ids[]" value="{{ $item->id }}">
                                </td>
                                <td class="align-middle">{{ $item->orangtua->nama_anak }}</td>
                                <td class="align-middle">{{ $totalJawaban[$item->orangtua->id] ?? 0  }} / {{ $totalBerkas }}</td>
                                <td class="text-center align-middle">
                                    <span class="badge
                                        @switch($item->status)
                                            @case('verifikasi') bg-info @break
                                            @case('lulus') bg-success @break
                                            @case('gagal') bg-danger @break
                                        @endswitch
                                        text-white text-uppercase">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('admin.seleksi.show', $item->id) }}"
                                           class="btn btn-sm btn-warning"
                                           data-bs-toggle="tooltip"
                                           title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <form action=""
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    data-bs-toggle="tooltip"
                                                    title="Hapus"
                                                    onclick="return confirm('Apakah anda yakin?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
    </section>
</div>

@endsection

@section('scripts')
<script>

$(document).ready(function() {
        // Select All checkbox
        $('#select-all').click(function() {
            $('input[name="selected_ids[]"]').prop('checked', this.checked);
        });
    })

    $(document).ready(function() {
        $('#table1').DataTable({
            "pageLength": 10,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "dom": '<"top"lf>rt<"bottom"ip><"clear">',
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampil _MENU_ entri",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "paginate": {
                    "previous": "<i class='bi bi-chevron-left'></i>",
                    "next": "<i class='bi bi-chevron-right'></i>"
                }
            },
            "columnDefs": [
                { "orderable": false, "targets": [0,4] }
            ]
        });

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection
