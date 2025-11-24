{{-- Revisi tampilan oleh Yusuf --}}
@extends('layouts.app')
@section('title', 'Daftar Pengaduan')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="mb-0">Daftar Pengaduan</h4>
    <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg"></i> Buat Pengaduan
    </a>
  </div>

  @if (session('ok'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-2"></i>{{ session('ok') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card card-shadow">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>Waktu</th>
              <th>Nama</th>
              <th>Judul</th>
              <th>Status</th>
              <th class="text-end">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data as $row)
              <tr>
                <td class="text-nowrap">{{ $row->created_at->format('d M Y H:i') }}</td>
                <td>{{ $row->nama }}</td>
                <td class="text-truncate" style="max-width: 420px;">{{ $row->judul }}</td>
                <td>
                  @php
                    $map = ['baru'=>'secondary','diproses'=>'warning','selesai'=>'success'];
                  @endphp
                  <span class="badge text-bg-{{ $map[$row->status] ?? 'secondary' }}">
                    {{ ucfirst($row->status) }}
                  </span>
                </td>
                <td class="text-end">
                  {{-- Form ubah status sederhana --}}
                  <form action="{{ route('pengaduan.update', $row) }}" method="post" class="d-inline">
                    @csrf @method('PUT')
                    <select name="status" class="form-select form-select-sm d-inline w-auto me-1">
                      <option value="baru"     @selected($row->status=='baru')>Baru</option>
                      <option value="diproses" @selected($row->status=='diproses')>Diproses</option>
                      <option value="selesai"  @selected($row->status=='selesai')>Selesai</option>
                    </select>
                    <button class="btn btn-sm btn-outline-primary">Simpan</button>
                  </form>

                  <form action="{{ route('pengaduan.destroy', $row) }}" method="post" class="d-inline"
                        onsubmit="return confirm('Hapus pengaduan ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-muted py-4">Belum ada pengaduan.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

