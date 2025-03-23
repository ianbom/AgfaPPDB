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
            <!-- Profile Card -->
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informasi Profil</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <div class="profile-image-container mb-3">
                                <img src="{{ isset($orangtua->profile_anak) ? asset('storage/'.$orangtua->profile_anak) : asset('assets/images/faces/1.jpg') }}"
                                     alt="Profile Anak"
                                     class="profile-image-vertical">
                            </div>
                            <h5>{{ $orangtua->nama_anak ?? 'Belum diisi' }}</h5>
                            <p class="text-muted mb-1">Anak dari {{ $orangtua->nama ?? auth()->user()->name }}</p>
                        </div>

                        <style>
                        .profile-image-container {
                            width: 200px;
                            height: 300px;
                            overflow: hidden;
                            border-radius: 8px;
                            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                        }

                        .profile-image-vertical {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            object-position: center;
                        }
                        </style>
                        <div class="mt-4">
                            <div class="list-group">
                                <a href="#profile-info" class="list-group-item list-group-item-action active" data-bs-toggle="list">
                                    <i class="bi bi-person-fill me-2"></i> Profil Orang Tua
                                </a>
                                <a href="#change-password" class="list-group-item list-group-item-action" data-bs-toggle="list">
                                    <i class="bi bi-key-fill me-2"></i> Ubah Password
                                </a>
                                <a href="#child-profile" class="list-group-item list-group-item-action" data-bs-toggle="list">
                                    <i class="bi bi-person-badge-fill me-2"></i> Profil Anak
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Sections -->
            <div class="col-12 col-md-8">
                <div class="tab-content">
                    <!-- Profile Information Form -->
                    <div class="tab-pane fade show active" id="profile-info">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Informasi Orang Tua</h4>
                                <p class="text-subtitle text-muted">Kelola informasi pribadi Anda</p>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('orangtua.profile.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row mb-4">
                                        <label for="email" class="col-md-3 col-form-label">Email</label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control disabled" id="email" value="{{ $user->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="nama" class="col-md-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $orangtua->nama ?? $user->name) }}">
                                            @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="no_hp" class="col-md-3 col-form-label">Nomor Handphone</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', $orangtua->no_hp ?? '') }}">
                                            @error('no_hp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="alamat" class="col-md-3 col-form-label">Alamat</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', $orangtua->alamat ?? '') }}</textarea>
                                            @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 offset-md-3">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Change Password Form -->
                    <div class="tab-pane fade" id="change-password">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Ubah Password</h4>
                                <p class="text-subtitle text-muted">Pastikan menggunakan password yang kuat</p>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row mb-4">
                                        <label for="current_password" class="col-md-4 col-form-label">Password Saat Ini</label>
                                        <div class="col-md-8">
                                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                                            @error('current_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="password" class="col-md-4 col-form-label">Password Baru</label>
                                        <div class="col-md-8">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="password_confirmation" class="col-md-4 col-form-label">Konfirmasi Password</label>
                                        <div class="col-md-8">
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">Ubah Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Child Profile Form -->
                    <div class="tab-pane fade" id="child-profile">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Profil Anak</h4>
                                <p class="text-subtitle text-muted">Informasi tentang anak Anda</p>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('orangtua.anak.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row mb-4">
                                        <label for="nama_anak" class="col-md-3 col-form-label">Nama Anak</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control @error('nama_anak') is-invalid @enderror" id="nama_anak" name="nama_anak" value="{{ old('nama_anak', $orangtua->nama_anak ?? '') }}">
                                            @error('nama_anak')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="profile_anak" class="col-md-3 col-form-label">Foto Anak</label>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                @if(isset($orangtua->profile_anak))
                                                <img src="{{ asset('storage/'.$orangtua->profile_anak) }}" alt="Foto Anak" class="img-fluid img-thumbnail" style="max-height: 200px">
                                                @endif
                                            </div>
                                            <input type="file" class="form-control @error('profile_anak') is-invalid @enderror" id="profile_anak" name="profile_anak">
                                            <small class="text-muted">Upload foto anak (format: jpg, jpeg, png, max: 2MB)</small>
                                            @error('profile_anak')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 offset-md-3">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
        // Activate tabs based on URL hash
        const hash = window.location.hash;
        if (hash) {
            const triggerEl = document.querySelector(`a[href="${hash}"]`);
            if (triggerEl) {
                triggerEl.click();
            }
        }

        // Update URL hash when tab is clicked
        const tabLinks = document.querySelectorAll('.list-group-item');
        tabLinks.forEach(link => {
            link.addEventListener('click', function() {
                window.location.hash = this.getAttribute('href');

                // Update active class manually
                tabLinks.forEach(tl => tl.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
@endsection
