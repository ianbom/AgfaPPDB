@extends('web.admin.layouts.app')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pemberkasan</h3>
                <p class="text-subtitle text-muted">Create Pemberkasan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Pemberkasan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                        <h4 class="card-title">Form Pemberkasan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{ route('admin.pemberkasan.store') }}">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="soal">Pertanyaan</label>
                                                <textarea class="form-control @error('soal') is-invalid @enderror"
                                                    id="soal" name="soal" rows="3"
                                                    placeholder="Masukkan pertanyaan pemberkasan">{{ old('soal') }}</textarea>
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
                                                    <option value="text" {{ old('tipe') == 'text' ? 'selected' : '' }}>Text (Input Text)</option>
                                                    <option value="radio" {{ old('tipe') == 'radio' ? 'selected' : '' }}>Radio (Pilihan Tunggal)</option>
                                                    <option value="checkbox" {{ old('tipe') == 'checkbox' ? 'selected' : '' }}>Checkbox (Pilihan Ganda)</option>
                                                    <option value="file" {{ old('tipe') == 'file' ? 'selected' : '' }}>File Upload</option>
                                                </select>
                                                @error('tipe')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Bagian opsi pemberkasan yang hanya ditampilkan untuk radio/checkbox -->
                                        <div class="col-12 pilihan-section" style="display: none;">
                                            <div class="form-group">
                                                <label>Pilihan Jawaban</label>
                                                <div id="opsi-container">
                                                    <!-- Container untuk opsi dinamis -->
                                                </div>
                                                <button type="button" class="btn btn-sm btn-secondary mt-2" id="tambah-opsi">
                                                    <i class="bi bi-plus-circle"></i> Tambah Pilihan
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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

        // Fungsi untuk menambahkan opsi baru
        function tambahOpsi() {
            const newOpsi = document.createElement('div');
            newOpsi.className = 'input-group mb-2';
            newOpsi.innerHTML = `
                <input type="text" name="opsi[]" class="form-control" placeholder="Masukkan pilihan">
                <button type="button" class="btn btn-danger remove-opsi">
                    <i class="bi bi-trash"></i>
                </button>
            `;
            opsiContainer.appendChild(newOpsi);

            // Tambahkan event listener untuk tombol hapus
            newOpsi.querySelector('.remove-opsi').addEventListener('click', function() {
                if (opsiContainer.children.length > 1) {
                    opsiContainer.removeChild(newOpsi);
                }
            });
        }

        // Inisialisasi tampilan berdasarkan tipe yang dipilih
        function updateTipeDisplay() {
            // Hanya tampilkan bagian pilihan jika tipe adalah radio atau checkbox
            if (tipeSelect.value === 'radio' || tipeSelect.value === 'checkbox') {
                pilihanSection.style.display = 'block';

                // Pastikan minimal ada dua opsi jika belum ada
                if (opsiContainer.children.length < 2) {
                    // Bersihkan container terlebih dahulu
                    opsiContainer.innerHTML = '';
                    tambahOpsi();
                    tambahOpsi();
                }
            } else {
                // Sembunyikan bagian pilihan untuk tipe text dan file
                pilihanSection.style.display = 'none';

                // Kosongkan container opsi untuk mencegah pengiriman data yang tidak perlu
                opsiContainer.innerHTML = '';
            }
        }

        // Event listener untuk perubahan tipe
        tipeSelect.addEventListener('change', updateTipeDisplay);

        // Event listener untuk tombol tambah opsi
        tambahOpsiBtn.addEventListener('click', tambahOpsi);

        // Event delegation untuk tombol hapus opsi
        opsiContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-opsi') || e.target.parentElement.classList.contains('remove-opsi')) {
                const button = e.target.classList.contains('remove-opsi') ? e.target : e.target.parentElement;
                const opsiItem = button.closest('.input-group');

                // Jangan hapus jika hanya tersisa satu opsi
                if (opsiContainer.children.length > 1) {
                    opsiContainer.removeChild(opsiItem);
                }
            }
        });

        // Jalankan saat halaman dimuat untuk mengatur tampilan awal
        updateTipeDisplay();

        // Jika ada nilai lama dari validasi yang gagal, atur kembali form
        @if(old('tipe') == 'radio' || old('tipe') == 'checkbox')
            @if(old('opsi'))
                // Bersihkan container terlebih dahulu
                opsiContainer.innerHTML = '';

                // Tambahkan opsi dari nilai lama
                @foreach(old('opsi') as $oldOpsi)
                    const oldOpsiElement = document.createElement('div');
                    oldOpsiElement.className = 'input-group mb-2';
                    oldOpsiElement.innerHTML = `
                        <input type="text" name="opsi[]" class="form-control" value="{{ $oldOpsi }}" placeholder="Masukkan pilihan">
                        <button type="button" class="btn btn-danger remove-opsi">
                            <i class="bi bi-trash"></i>
                        </button>
                    `;
                    opsiContainer.appendChild(oldOpsiElement);
                @endforeach

                // Tambahkan event listener untuk semua tombol hapus
                document.querySelectorAll('.remove-opsi').forEach(button => {
                    button.addEventListener('click', function() {
                        if (opsiContainer.children.length > 1) {
                            opsiContainer.removeChild(this.closest('.input-group'));
                        }
                    });
                });
            @endif
        @endif
    });
</script>
@endsection
