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
                <h3>Profile Orang Tua</h3>
                <p class="text-subtitle text-muted">Manajemen Profile Orangtua</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Orangtua</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            @foreach($pemberkasan as $item)
            <div class="col-md-8 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-3">
                            <!-- Icon Container -->
                            <div class="icon-wrapper bg-primary p-3 rounded-3">
                                <i class="bi
                                    @switch($item->tipe)
                                        @case('text') bi-input-cursor-text @break
                                        @case('radio') bi-ui-radios @break
                                        @case('checkbox') bi-ui-checks @break
                                        @case('file') bi-file-earmark-arrow-up @break
                                    @endswitch
                                text-white fs-4"></i>
                            </div>
            
                            <!-- Content -->
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-primary-subtle text-primary text-uppercase">
                                        {{ $item->tipe }}
                                    </span>
                                    <div class="d-flex flex-column align-items-end">
                                        <small class="text-muted">#{{ $loop->iteration }}</small>
                                        @if (isset($jawaban[$item->id]))
                                            <span class="badge bg-success-subtle text-success mt-1">
                                                <i class="bi bi-check-circle-fill me-1"></i>Sudah Diisi
                                            </span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning mt-1">
                                                <i class="bi bi-exclamation-circle-fill me-1"></i>Belum Diisi
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <h5 class="card-title mb-3">{{ $item->soal }}</h5>
                            </div>
                        </div>
            
                        <!-- Action Button --> 
                        <div class="d-grid mt-3">
                        @if (isset($jawaban[$item->id]))
                        <a href="{{ route('orangtua.pemberkasan.edit', $jawaban[$item->id] ) }}"
                            class="btn btn-outline-primary d-flex align-items-center justify-content-center gap-2">
                             <i class="bi bi-pencil-square"></i>
                             <span>Edit Jawaban</span>
                         </a>
                            @else
                        <a href="{{ route('orangtua.pemberkasan.show', $item->id) }}"
                           class="btn btn-outline-success d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-pencil-square"></i>
                            <span>Isi Sekarang</span>
                        </a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Progress Section -->
        <div class="sticky-bottom progress-container mt-5">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Progress Pemberkasan</h5>
                            <small class="text-muted">Lengkapi semua data untuk melanjutkan</small>
                        </div>
                        <div class="text-end">
                            @php
                                $progressPercentage = $totalPemberkasan > 0 ? round(($totalJawaban / $totalPemberkasan) * 100) : 0;
                            @endphp
                            <h2 class="mb-0 text-primary">{{ $progressPercentage }}%</h2>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $progressPercentage }}%"
                             aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <small class="text-muted">{{ $totalJawaban }} dari {{ $totalPemberkasan }} dokumen terisi</small>
                        @if($progressPercentage < 100)
                            <small class="text-primary">{{ $totalPemberkasan - $totalJawaban }} dokumen belum diisi</small>
                        @else
                            <small class="text-success">Semua dokumen telah lengkap</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .card {
        border-radius: 12px;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.1);
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .icon-wrapper {
        min-width: 50px;
        text-align: center;
    }

    .progress-container {
        position: sticky;
        bottom: 20px;
        z-index: 100;
    }

    .btn-outline-primary {
        transition: all 0.3s ease;
        border-width: 2px;
    }

    .btn-outline-primary:hover {
        background-color: var(--bs-primary);
        color: white !important;
    }
</style>

@endsection
