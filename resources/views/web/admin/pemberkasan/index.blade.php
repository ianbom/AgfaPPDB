@extends('web.admin.layouts.app')
@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

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
                <h3>Data Pemberkasan</h3>
                <p class="text-subtitle text-muted">Manajemen pertanyaan dan opsi pemberkasan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pemberkasan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar Pemberkasan</h4>
                <a href="{{ route('admin.pemberkasan.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Baru
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table1">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Pertanyaan</th>
                                <th class="text-center">Tipe</th>
                                <th>Opsi Jawaban</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemberkasan as $item)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle" style="max-width: 400px;">{{ $item->soal }}</td>
                                <td class="text-center align-middle">
                                    <span class="badge
                                        @switch($item->tipe)
                                            @case('text') bg-info @break
                                            @case('radio') bg-success @break
                                            @case('checkbox') bg-warning @break
                                            @case('file') bg-danger @break
                                        @endswitch
                                        text-white text-uppercase">
                                        {{ $item->tipe }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    @if(in_array($item->tipe, ['radio', 'checkbox']))
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($item->opsiPemberkasan as $opsi)
                                                <span class="badge bg-light-primary rounded-pill">
                                                    {{ $opsi->opsi }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('admin.pemberkasan.edit', $item->id) }}"
                                           class="btn btn-sm btn-warning"
                                           data-bs-toggle="tooltip"
                                           title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.pemberkasan.destroy', $item->id) }}"
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
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('scripts')
<script>
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
                { "orderable": false, "targets": [4] }
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
