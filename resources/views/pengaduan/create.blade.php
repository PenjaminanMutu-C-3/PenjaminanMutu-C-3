{{-- Revisi tampilan form pengaduan oleh Yusuf --}}
@extends('layouts.app')
@section('title', 'Form Pengaduan')

@section('content')
  <div class="row justify-content-center">
    <div class="col-lg-8 col-xl-7">
      <a href="{{ route('pengaduan.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>

      {{-- Notifikasi sukses --}}
      @if (session('ok'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle me-2"></i>{{ session('ok') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      {{-- Ringkasan error --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <div class="fw-semibold mb-1"><i class="bi bi-exclamation-triangle me-1"></i>Periksa kembali:</div>
          <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="card card-shadow">
        <div class="card-header bg-white">
          <h5 class="mb-0"><i class="bi bi-megaphone text-primary me-2"></i>Form Pengaduan</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('pengaduan.store') }}" method="POST" novalidate>
            @csrf

            <div class="mb-3">
              <label class="form-label required">Nama</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="nama"
                       value="{{ old('nama') }}"
                       class="form-control @error('nama') is-invalid @enderror"
                       placeholder="Nama lengkap pelapor" autofocus>
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Kontak (Email/WA)</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="text" name="kontak"
                       value="{{ old('kontak') }}"
                       class="form-control @error('kontak') is-invalid @enderror"
                       placeholder="email@contoh.com atau 08xxxx">
                @error('kontak') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="form-text">Opsional, namun memudahkan admin menghubungi balik.</div>
            </div>

            <div class="mb-3">
              <label class="form-label required">Judul</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-flag"></i></span>
                <input type="text" name="judul"
                       value="{{ old('judul') }}"
                       class="form-control @error('judul') is-invalid @enderror"
                       placeholder="Mis. Jalan rusak, Lampu mati, dll">
                @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label required">Isi Pengaduan</label>
              <textarea name="isi" rows="5"
                        class="form-control @error('isi') is-invalid @enderror"
                        placeholder="Jelaskan lokasi/kejadian, detail keluhan, dan harapan penanganan...">{{ old('isi') }}</textarea>
              @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-grid d-sm-flex justify-content-end gap-2">
              <button class="btn btn-primary px-4">
                <i class="bi bi-send me-1"></i> Kirim Pengaduan
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
