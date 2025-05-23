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
                <h3>Pemberkasan Siswa</h3>
                <p class="text-subtitle text-muted">Manajemen Pemberkasan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Pemberkasan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Siswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row g-3">
            @foreach($pemberkasan as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-3">
                        <!-- Header with status -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi
                                    @switch($item->tipe)
                                        @case('text') bi-input-cursor-text @break
                                        @case('radio') bi-ui-radios @break
                                        @case('checkbox') bi-ui-checks @break
                                        @case('file') bi-file-earmark-arrow-up @break
                                    @endswitch
                                text-primary me-2"></i>
                                <span class="small text-uppercase text-muted">{{ $item->tipe }}</span>
                            </div>
                            @if (isset($jawaban[$item->id]))
                                <span class="badge bg-success rounded-pill">
                                    <i class="bi bi-check-circle-fill me-1"></i>Terisi
                                </span>
                            @else
                                <span class="badge bg-warning rounded-pill">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>Belum
                                </span>
                            @endif
                        </div>

                        <!-- Question -->
                        <h6 class="card-title mb-3">{{ $item->soal }}</h6>

                        <!-- Action Button -->
                        @if (isset($jawaban[$item->id]))
                        <a href="{{ route('orangtua.pemberkasan.edit', $jawaban[$item->id] ) }}"
                            class="btn btn-sm btn-outline-primary w-100">
                            <i class="bi bi-pencil-square me-1"></i>Edit Jawaban
                        </a>
                        @else
                        <a href="{{ route('orangtua.pemberkasan.show', $item->id) }}"
                            class="btn btn-sm btn-outline-success w-100">
                            <i class="bi bi-pencil-square me-1"></i>Isi Sekarang
                        </a>
                        @endif
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
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }

    .btn-sm {
        padding: 0.375rem 0.75rem;
    }
</style>

@endsection
