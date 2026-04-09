@extends('layouts.admin') {{-- Pastikan mengacu ke layout admin kamu --}}

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark">Manajemen Anggota</h2>
                <p class="text-muted">Kelola data anggota perpustakaan</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-4">
                <div class="input-group mb-4 shadow-sm" style="border-radius: 10px; overflow: hidden;">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control border-0" placeholder="Cari nama, NIS, atau kelas...">
                </div>

                <div class="table-responsive">
                    {{-- resources/views/admin/anggota.blade.php --}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->nis ?? '2021001' }}</td> {{-- Sesuaikan kolom di DB kamu --}}
                                    <td>{{ $member->kelas ?? 'XII RPL' }}</td>
                                    <td>{{ $member->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
