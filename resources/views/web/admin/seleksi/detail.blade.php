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
                <p class="text-subtitle text-muted">Manajemen data seleksi siswa</p>
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
        <div class="row">
            <!-- Profil Anak -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Profil Anak</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if($orangtua->profile_anak)
                                <img src="{{ asset('storage/' . $orangtua->profile_anak) }}" alt="Profil Anak" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="avatar bg-primary me-3" style="width: 150px; height: 150px; display: flex; align-items: center; justify-content: center;">
                                    <span class="avatar-content" style="font-size: 60px;">{{ substr($orangtua->nama_anak ?? 'A', 0, 1) }}</span>
                                </div>
                            @endif
                            <div class="mt-3">
                                <h4>{{ $orangtua->nama_anak }}</h4>
                                <p class="text-secondary mb-1">Calon Siswa</p>
                                <p class="text-muted font-size-sm">ID Seleksi: {{ $seleksi->id }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Data Orang Tua</h4>
                        <div class="badge bg-success">{{ $seleksi->status ?? 'Proses Seleksi' }}</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-item d-flex border-bottom pb-3 mb-3">
                                    <div class="info-icon me-3">
                                        <i class="bi bi-person-fill text-primary" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div class="info-details">
                                        <span class="text-muted">Nama Orang Tua</span>
                                        <h6 class="mb-0 mt-1">{{ $orangtua->nama }}</h6>
                                    </div>
                                </div>

                                <div class="info-item d-flex border-bottom pb-3 mb-3">
                                    <div class="info-icon me-3">
                                        <i class="bi bi-telephone-fill text-primary" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div class="info-details">
                                        <span class="text-muted">Nomor HP</span>
                                        <h6 class="mb-0 mt-1">{{ $orangtua->no_hp }}</h6>
                                    </div>
                                </div>

                                <div class="info-item d-flex border-bottom pb-3 mb-3">
                                    <div class="info-icon me-3">
                                        <i class="bi bi-geo-alt-fill text-primary" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div class="info-details">
                                        <span class="text-muted">Alamat</span>
                                        <h6 class="mb-0 mt-1">{{ $orangtua->alamat }}</h6>
                                    </div>
                                </div>

                                <div class="info-item d-flex">
                                    <div class="info-icon me-3">
                                        <i class="bi bi-calendar2-check-fill text-primary" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div class="info-details">
                                        <span class="text-muted">Terdaftar Pada</span>
                                        <h6 class="mb-0 mt-1">{{ $orangtua->created_at->format('d M Y, H:i') }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Jawaban -->
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title text-white mb-0">Data Jawaban Pemberkasan</h4>
            </div>
            <div class="card-body mt-2">
                @if(count($jawaban) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table1">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center" style="width: 60px;">No</th>
                                    <th style="width: 40%;">Pertanyaan</th>
                                    <th>Jawaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pemberkasan as $index => $item)
                                @php
                                        $jawabanSiswa = $jawaban->firstWhere('pemberkasan_id', $item->id);
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $item->soal ?? 'Tidak ada pertanyaan' }}</td>
                                        <td>{{ $jawabanSiswa->jawaban ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Tidak ada data jawaban pemberkasan
                    </div>
                @endif
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
                { "orderable": false, "targets": [] }
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
