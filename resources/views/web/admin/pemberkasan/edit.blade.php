@extends('web.admin.layouts.app')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pemberkasan</h3>
                <p class="text-subtitle text-muted">Edit Pemberkasan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.pemberkasan.index') }}">Pemberkasan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Edit Pemberkasan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST"
                                action="{{ route('admin.pemberkasan.update', $pemberkasan->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="soal">Pertanyaan</label>
                                                <textarea class="form-control @error('soal') is-invalid @enderror"
                                                    id="soal" name="soal" rows="3"
                                                    placeholder="Masukkan pertanyaan pemberkasan">{{ old('soal', $pemberkasan->soal) }}</textarea>
                                                @error('soal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="tipe">Tipe Jawaban</label>
                                                <select class="form-select @error('tipe') is-invalid @enderror"
                                                    id="tipe" name="tipe">
                                                    <option value="">Pilih Tipe</option>
                                                    <option value="text" {{ $pemberkasan->tipe == 'text' ? 'selected' : '' }}>Text (Input Text)</option>
                                                    <option value="radio" {{ $pemberkasan->tipe == 'radio' ? 'selected' : '' }}>Radio (Pilihan Tunggal)</option>
                                                    <option value="checkbox" {{ $pemberkasan->tipe == 'checkbox' ? 'selected' : '' }}>Checkbox (Pilihan Ganda)</option>
                                                    <option value="file" {{ $pemberkasan->tipe == 'file' ? 'selected' : '' }}>File Upload</option>
                                                </select>
                                                @error('tipe')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 pilihan-section"
                                            style="display: {{ in_array($pemberkasan->tipe, ['radio','checkbox']) ? 'block' : 'none' }};">
                                            <div class="form-group">
                                                <label>Pilihan Jawaban</label>
                                                <div id="opsi-container">
                                                    @if(old('opsi'))
                                                        @foreach(old('opsi') as $index => $opsi)
                                                            <div class="input-group mb-2">
                                                                <input type="text" name="opsi[]"
                                                                    class="form-control @error('opsi.*') is-invalid @enderror"
                                                                    value="{{ $opsi }}"
                                                                    placeholder="Masukkan pilihan">
                                                                <button type="button" class="btn btn-danger remove-opsi">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        @foreach($pemberkasan->opsiPemberkasan as $opsi)
                                                            <div class="input-group mb-2">
                                                                <input type="text" name="opsi[]"
                                                                    class="form-control"
                                                                    value="{{ $opsi->opsi }}"
                                                                    placeholder="Masukkan pilihan">
                                                                <button type="button" class="btn btn-danger remove-opsi">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    @error('opsi.*')
                                                    <div class="text-danger small">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <button type="button" class="btn btn-sm btn-secondary mt-2" id="tambah-opsi">
                                                    <i class="bi bi-plus-circle"></i> Tambah Pilihan
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                            <a href="{{ route('admin.pemberkasan.index') }}"
                                                class="btn btn-light-secondary me-1 mb-1">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipeSelect = document.getElementById('tipe');
        const pilihanSection = document.querySelector('.pilihan-section');
        const opsiContainer = document.getElementById('opsi-container');
        const tambahOpsiBtn = document.getElementById('tambah-opsi');

        function tambahOpsi(value = '') {
            const newOpsi = document.createElement('div');
            newOpsi.className = 'input-group mb-2';
            newOpsi.innerHTML = `
                <input type="text" name="opsi[]" class="form-control"
                    value="${value}"
                    placeholder="Masukkan pilihan">
                <button type="button" class="btn btn-danger remove-opsi">
                    <i class="bi bi-trash"></i>
                </button>
            `;
            opsiContainer.appendChild(newOpsi);
        }

        function updateTipeDisplay() {
            if (tipeSelect.value === 'radio' || tipeSelect.value === 'checkbox') {
                pilihanSection.style.display = 'block';

                // Jika tidak ada opsi, tambahkan 2 opsi default
                if (opsiContainer.children.length === 0) {
                    tambahOpsi();
                    tambahOpsi();
                }
            } else {
                pilihanSection.style.display = 'none';
            }
        }

        tipeSelect.addEventListener('change', updateTipeDisplay);

        tambahOpsiBtn.addEventListener('click', () => tambahOpsi());

        opsiContainer.addEventListener('click', function(e) {
            if (e.target.closest('.remove-opsi')) {
                const opsiItem = e.target.closest('.input-group');
                if (opsiContainer.children.length > 1) {
                    opsiContainer.removeChild(opsiItem);
                }
            }
        });

        // Handle existing options
        @if(!old('opsi') && $pemberkasan->opsiPemberkasan->isEmpty())
            if (tipeSelect.value === 'radio' || tipeSelect.value === 'checkbox') {
                tambahOpsi();
                tambahOpsi();
            }
        @endif
    });
</script>
@endsection
