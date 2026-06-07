@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Laporan Persediaan</h1>
        <p class="page-desc">Melihat, memfilter, mencetak, dan mengunduh laporan transaksi persediaan barang.</p>
    </div>

    <div class="card">
        {{-- Form filter membatasi laporan berdasarkan tanggal awal dan tanggal akhir. --}}
        <form action="/reports" method="GET" style="display: flex; gap: 12px; align-items: end; flex-wrap: wrap; margin-bottom: 18px;">
            <div style="width: 220px;">
                <label>Tanggal Awal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}">
            </div>

            <div style="width: 220px;">
                <label>Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}">
            </div>

            <button type="submit" class="btn">Filter</button>
            <a href="/reports" class="btn btn-secondary">Reset</a>

            {{-- Link print membuka tampilan cetak dengan filter tanggal yang sama. --}}
            <a href="/reports/print?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}"
               target="_blank"
               class="btn btn-success">
                Print
            </a>

            {{-- Link PDF mengunduh laporan dalam format PDF. --}}
            <a href="/reports/pdf?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}"
               class="btn btn-danger">
                Download PDF
            </a>

            {{-- Link CSV mengunduh laporan agar bisa dibuka di aplikasi spreadsheet. --}}
            <a href="/reports/excel?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}"
               class="btn btn-success">
                Download CSV
            </a>
        </form>

        <div class="table-wrapper">
            {{-- Tabel menampilkan transaksi stok sesuai hasil filter laporan. --}}
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse menampilkan data transaksi atau pesan kosong jika laporan belum tersedia. --}}
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->date }}</td>
                            {{-- Tanda ?? '-' dipakai jika relasi barang tidak ditemukan. --}}
                            <td>{{ $transaction->product->code ?? '-' }}</td>
                            <td>{{ $transaction->product->name ?? '-' }}</td>
                            <td>
                                {{-- Jenis transaksi diberi badge berbeda antara masuk dan keluar. --}}
                                @if ($transaction->type == 'masuk')
                                    <span class="badge badge-success">Masuk</span>
                                @else
                                    <span class="badge badge-danger">Keluar</span>
                                @endif
                            </td>
                            <td>{{ $transaction->quantity }}</td>
                            <td>{{ $transaction->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;">Data laporan belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
