@extends('layouts.app')
@section('title', 'Daftar Pengaduan')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- HERO HEADER --}}
    <div class="mb-8">
        <div class="relative rounded-2xl overflow-hidden bg-gradient-to-r from-indigo-600 via-violet-600 to-fuchsia-600 p-[1px] shadow-lg">
            <div class="rounded-2xl bg-white/95 px-6 py-7 sm:px-8 sm:py-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">

                    {{-- KIRI: ICON + JUDUL --}}
                    <div class="flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-600/10">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" stroke-width="1.8"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M7 8h10M7 12h6m-6 4h10M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">
                                Daftar Pengaduan
                            </h1>
                            <p class="text-sm text-gray-600 mt-1">
                                Kelola laporan masyarakat secara cepat, transparan, dan tertata.
                            </p>

                            <div class="mt-3 flex gap-2 flex-wrap">
                                <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700 font-medium">
                                    Total: {{ $data->count() }} laporan
                                </span>
                                <span class="px-3 py-1 text-xs rounded-full bg-indigo-50 text-indigo-700 font-medium">
                                    SIPMAS • Sistem Pengaduan
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- KANAN: TOMBOL BUAT PENGADUAN --}}
                    @if(auth()->user()->role === 'user')
                        <a href="{{ route('pengaduan.create') }}"
                           class="inline-flex items-center px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-md transition active:scale-[0.97]">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 4v16m8-8H4"/>
                            </svg>
                            Buat Pengaduan
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- ALERT SUKSES --}}
    @if (session('ok'))
        <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700 text-sm shadow-sm">
            ✅ {{ session('ok') }}
        </div>
    @endif

    {{-- CARD TABEL --}}
    <div class="bg-white shadow-lg rounded-2xl border border-gray-100 overflow-hidden">

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-gray-600">Waktu</th>
                        <th class="px-6 py-4 font-semibold text-gray-600">Nama</th>
                        <th class="px-6 py-4 font-semibold text-gray-600">Judul</th>
                        <th class="px-6 py-4 font-semibold text-gray-600">Status</th>

                        @if(auth()->user()->role === 'admin')
                            <th class="px-6 py-4 font-semibold text-gray-600 text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($data as $row)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                {{ $row->created_at->format('d M Y H:i') }}
                            </td>

                            <td class="px-6 py-4 text-gray-800 font-medium">
                                {{ $row->nama }}
                            </td>

                            <td class="px-6 py-4 max-w-md truncate text-gray-700">
                                {{ $row->judul }}
                            </td>

                            {{-- BADGE STATUS --}}
                            <td class="px-6 py-4">
                                @php
                                    $map = [
                                        'baru'     => 'bg-gray-100 text-gray-700 ring-gray-200',
                                        'diproses' => 'bg-yellow-100 text-yellow-700 ring-yellow-300',
                                        'selesai'  => 'bg-green-100 text-green-700 ring-green-300',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold ring-1
                                             {{ $map[$row->status] ?? 'bg-gray-100 text-gray-700 ring-gray-200' }}">
                                    {{ ucfirst($row->status) }}
                                </span>
                            </td>

                            {{-- AKSI ADMIN --}}
                            @if(auth()->user()->role === 'admin')
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end flex-wrap gap-2">

                                        <a href="{{ route('pengaduan.show', $row) }}"
                                           class="px-3 py-1.5 rounded-lg border border-gray-200 text-xs font-medium
                                                  text-gray-700 hover:bg-gray-100 transition">
                                            Detail
                                        </a>

                                        <form action="{{ route('pengaduan.update', $row) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PUT')

                                            <select name="status"
                                                    class="text-xs border-gray-200 rounded-lg px-2 py-1 focus:ring-indigo-500 focus:border-indigo-500">
                                                <option value="baru"     @selected($row->status == 'baru')>Baru</option>
                                                <option value="diproses" @selected($row->status == 'diproses')>Diproses</option>
                                                <option value="selesai"  @selected($row->status == 'selesai')>Selesai</option>
                                            </select>

                                            <button class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs
                                                           font-semibold rounded-lg shadow-sm transition">
                                                Simpan
                                            </button>
                                        </form>

                                        <form action="{{ route('pengaduan.destroy', $row) }}"
                                              method="POST"
                                              onsubmit="return confirm('Hapus pengaduan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs
                                                           font-semibold rounded-lg shadow-sm transition">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            @endif

                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role === 'admin' ? 5 : 4 }}"
                                class="px-6 py-10 text-center text-gray-500">
                                Belum ada pengaduan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection
