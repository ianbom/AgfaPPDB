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
                <h3>Pengisian Pemberkasan Siswa</h3>
                <p class="text-subtitle text-muted">Manajemen Pemberkasan Siswa</p>
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
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-text-fill me-2 text-primary"></i>
                    <h4 class="card-title mb-0">Edit Pemberkasan - {{ $pemberkasan->soal }}</h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('orangtua.pemberkasan.update', $jawaban->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="pemberkasan_id" value="{{ $pemberkasan->id }}">
                    
                    <div class="form-body py-2">
                        @if($pemberkasan->tipe === 'text')
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold mb-2">
                                <i class="bi bi-pencil-square me-1 text-primary"></i>
                                Jawaban Teks
                            </label>
                            <textarea
                                class="form-control @error('jawaban') is-invalid @enderror"
                                name="jawaban"
                                rows="4"
                                placeholder="Masukkan jawaban anda"
                                style="border-radius: 8px; border-color: #dfe3e7;">{{ old('jawaban', $jawaban->jawaban) }}</textarea>
                            @error('jawaban')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle-fill me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        @elseif($pemberkasan->tipe === 'radio')
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold mb-2">
                                <i class="bi bi-list-check me-1 text-primary"></i>
                                Pilih Jawaban
                            </label>
                            <div class="options-container bg-light">
                                @foreach($pemberkasan->opsiPemberkasan as $opsi)
                                <div class="form-check option-item">
                                    <input
                                        class="form-check-input @error('jawaban') is-invalid @enderror"
                                        type="radio"
                                        name="jawaban"
                                        id="opsi{{ $opsi->id }}"
                                        value="{{ $opsi->id }}"
                                        {{ old('jawaban', $jawaban->jawaban) == $opsi->opsi ? 'checked' : '' }}>
                                    <label class="form-check-label" for="opsi{{ $opsi->id }}">
                                        {{ $opsi->opsi }}
                                    </label>
                                </div>
                                @endforeach
                                @error('jawaban')
                                <div class="text-danger small mt-2 px-2">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        @elseif($pemberkasan->tipe === 'checkbox')
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold mb-2">
                                <i class="bi bi-list-check me-1 text-primary"></i>
                                Pilih Jawaban
                            </label>
                            <div class="options-container bg-light">
                                @foreach($pemberkasan->opsiPemberkasan as $opsi)
                                <div class="form-check option-item">
                                    <input
                                        class="form-check-input @error('jawaban') is-invalid @enderror"
                                        type="checkbox"
                                        name="jawaban[]"
                                        id="opsi{{ $opsi->id }}"
                                        value="{{ $opsi->id }}"
                                       >
                                    <label class="form-check-label" for="opsi{{ $opsi->id }}">
                                        {{ $opsi->opsi }}
                                    </label>
                                </div>
                                @endforeach
                                @error('jawaban')
                                <div class="text-danger small mt-2 px-2">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        @elseif($pemberkasan->tipe === 'file')
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold mb-2">
                                <i class="bi bi-file-earmark-arrow-up me-1 text-primary"></i>
                                Upload Berkas
                            </label>
                            <div class="file-upload-wrapper">
                                <input
                                    type="file"
                                    class="form-control @error('jawaban') is-invalid @enderror"
                                    name="jawaban"
                                    style="border-radius: 8px; border-color: #dfe3e7;">
                                
                                @if($jawaban->jawaban)
                                <div class="file-info mt-2 d-flex align-items-center">
                                    <span class="badge bg-light text-dark me-2">
                                        <i class="bi bi-file-earmark me-1"></i>
                                        File Saat Ini
                                    </span>
                                    <a href="{{ Storage::url($jawaban->jawaban) }}" 
                                       target="_blank"
                                       class="text-primary">
                                        Lihat File
                                    </a>
                                </div>
                                @endif
                                
                                <div class="file-info mt-2 d-flex align-items-center">
                                    <span class="badge bg-light text-dark me-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Format
                                    </span>
                                    <small class="text-muted">PDF, JPG, PNG (Maks. 2MB)</small>
                                </div>
                                @error('jawaban')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        @endif

                        <div class="form-group mt-5">
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-save me-1"></i>
                                    Update Jawaban
                                </button>
                                <a href="{{ route('orangtua.pemberkasan.index') }}" class="btn btn-light-secondary ms-2">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<style>
    /* Styling umum */
    .card {
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.2rem 1.5rem;
    }

    .card-title {
        color: #495057;
        font-weight: 600;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Form styling */
    .form-control:focus {
        border-color: #435ebe;
        box-shadow: 0 0 0 0.15rem rgba(67, 94, 190, 0.15);
    }

    .form-control::placeholder {
        color: #c0c7d1;
    }

    /* Options container */
    .options-container {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.8rem;
        transition: all 0.3s ease;
    }

    .options-container:hover {
        border-color: #435ebe;
        background-color: #f8f9fa;
    }

    .option-item {
        padding: 0.7rem 0.5rem 0.7rem 2.5rem;
        margin: 0.3rem 0;
        border-radius: 6px;
        transition: background-color 0.2s;
    }

    .option-item:hover {
        background-color: rgba(67, 94, 190, 0.05);
    }

    .form-check-input {
        width: 1.2em;
        height: 1.2em;
        margin-left: -2rem;
        border: 1.5px solid #6c757d;
    }

    .form-check-input:checked {
        background-color: #435ebe;
        border-color: #435ebe;
    }

    /* File upload */
    .file-upload-wrapper {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
    }

    .file-info {
        border-top: 1px dashed #e2e8f0;
        padding-top: 0.8rem;
        margin-top: 0.8rem;
    }

    /* Buttons */
    .btn {
        border-radius: 8px;
        padding: 0.5rem 1.2rem;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-primary {
        background-color: #435ebe;
        border-color: #435ebe;
    }

    .btn-primary:hover {
        background-color: #3950a2;
        border-color: #3950a2;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(67, 94, 190, 0.3);
    }

    .btn-light-secondary {
        background-color: #f6f8fa;
        border-color: #dfe3e7;
        color: #6c757d;
    }

    .btn-light-secondary:hover {
        background-color: #e9ecef;
        color: #495057;
    }
</style>

@endsection