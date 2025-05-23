@extends('web.orangtua.layouts.app')
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
                <h3>Pengumuman Seleksi</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Pengumuman</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Seleksi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                @if($seleksi->status == 'verifikasi')
                    <!-- Status Verifikasi -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 text-center">
                            {{-- <div class="d-flex justify-content-center mb-3">
                                <div class="status-icon bg-warning-light">
                                    <i class="bi bi-hourglass-split text-warning fs-1"></i>
                                </div>
                            </div> --}}
                            <h3 class="mb-3">Dalam Proses Verifikasi</h3>
                            <p class="text-muted mb-4">Pendaftaran Anda sedang dalam proses verifikasi. Mohon tunggu informasi selanjutnya.</p>

                            <div class="timeline mb-4">
                                <div class="timeline-item active">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-0">Pendaftaran</h6>
                                        <small class="text-muted">Selesai pada {{ $seleksi->created_at }}</small>
                                    </div>
                                </div>
                                <div class="timeline-item active">
                                    <div class="timeline-marker bg-warning"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-0">Verifikasi</h6>
                                        <small class="text-muted">Sedang diproses...</small>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-0">Pengumuman Hasil</h6>
                                        <small class="text-muted">Estimasi {{ $seleksi->created_at }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-light border">
                                <i class="bi bi-info-circle me-2"></i>
                                Hasil seleksi akan diumumkan pada. Anda juga akan menerima notifikasi melalui email.
                            </div>
                        </div>
                    </div>

                @elseif($seleksi->status == 'lulus')
                    <!-- Status Lulus -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 text-center">
                            {{-- <div class="d-flex justify-content-center mb-3">
                                <div class="status-icon bg-success-light">
                                    <i class="bi bi-check-circle-fill text-success fs-1"></i>
                                </div>
                            </div> --}}
                            <h3 class="mb-3 text-success">Selamat! Anda Dinyatakan Lulus</h3>
                            <p class="text-muted mb-4">Anda telah dinyatakan lulus seleksi. Silakan lengkapi proses berikutnya untuk melanjutkan pendaftaran.</p>

                            <div class="timeline mb-4">
                                <div class="timeline-item active">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-0">Pendaftaran</h6>
                                        <small class="text-muted">Selesai pada {{ $seleksi->created_at }}</small>
                                    </div>
                                </div>
                                <div class="timeline-item active">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-0">Verifikasi</h6>
                                        <small class="text-muted">Selesai pada {{ $seleksi->created_at }}</small>
                                    </div>
                                </div>
                                <div class="timeline-item active">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-0">Pengumuman Hasil</h6>
                                        <small class="text-success">Lulus Seleksi!</small>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4 bg-light border-0">
                                <div class="card-body">
                                    <h5 class="card-title">Informasi Daftar Ulang</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Nomor Pendaftaran:</strong></p>
                                            <p>123</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Tanggal Daftar Ulang:</strong></p>
                                            <p>{{ $seleksi->created_at }}</p>
                                        </div>
                                    </div>
                                    <div class="alert alert-warning">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        Harap selesaikan proses daftar ulang sebelum batas waktu yang ditentukan.
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="" class="btn btn-primary px-4">
                                    <i class="bi bi-arrow-right-circle me-2"></i>Lanjutkan ke Daftar Ulang
                                </a>
                                <a href="" class="btn btn-outline-primary px-4">
                                    <i class="bi bi-printer me-2"></i>Cetak Pengumuman
                                </a>
                            </div>
                        </div>
                    </div>

                @else
                    <!-- Status Gagal -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 text-center">
                            {{-- <div class="d-flex justify-content-center mb-3">
                                <div class="status-icon bg-danger-light">
                                    <i class="bi bi-x-circle-fill text-danger fs-1"></i>
                                </div>
                            </div> --}}
                            <h3 class="mb-3 text-danger">Mohon Maaf, Anda Belum Lulus Seleksi</h3>
                            <p class="text-muted mb-4">Terima kasih telah berpartisipasi dalam proses seleksi ini. Kami mendorong Anda untuk mencoba lagi di kesempatan berikutnya.</p>

                            <div class="timeline mb-4">
                                <div class="timeline-item active">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-0">Pendaftaran</h6>
                                        <small class="text-muted">Selesai pada {{ $seleksi->created_at }}</small>
                                    </div>
                                </div>
                                <div class="timeline-item active">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-0">Verifikasi</h6>
                                        <small class="text-muted">Selesai pada {{ $seleksi->created_at }}</small>
                                    </div>
                                </div>
                                <div class="timeline-item active">
                                    <div class="timeline-marker bg-danger"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-0">Pengumuman Hasil</h6>
                                        <small class="text-danger">Tidak Lulus</small>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-light border mb-4">
                                <i class="bi bi-info-circle me-2"></i>
                                Jika Anda memiliki pertanyaan, silakan hubungi kami di <strong>07654346</strong> atau kunjungi sekolah kami.
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-house me-2"></i>Kembali ke Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>

<style>
    .status-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .bg-success-light {
        background-color: rgba(25, 135, 84, 0.1);
    }

    .bg-warning-light {
        background-color: rgba(255, 193, 7, 0.1);
    }

    .bg-danger-light {
        background-color: rgba(220, 53, 69, 0.1);
    }

    .timeline {
        position: relative;
        max-width: 600px;
        margin: 0 auto;
    }

    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
        left: 32px;
        margin-left: -1px;
    }

    .timeline-item {
        position: relative;
        padding-left: 60px;
        padding-bottom: 20px;
        text-align: left;
    }

    .timeline-marker {
        position: absolute;
        top: 0;
        left: 30px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 2px solid #fff;
        background: #dee2e6;
        transform: translateX(-50%);
        z-index: 10;
    }

    .timeline-marker.bg-success {
        background: #198754;
    }

    .timeline-marker.bg-warning {
        background: #ffc107;
    }

    .timeline-marker.bg-danger {
        background: #dc3545;
    }

    .timeline-content {
        margin-bottom: 10px;
    }
</style>

@endsection
