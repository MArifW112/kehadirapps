@extends('layouts.layout')

@section('title', 'Dashboard Kehadiran')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Pengajuan Izin</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="sakit-tab" data-bs-toggle="tab" data-bs-target="#sakit" type="button" role="tab" aria-controls="sakit" aria-selected="true">Sakit</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="cuti-tab" data-bs-toggle="tab" data-bs-target="#cuti" type="button" role="tab" aria-controls="cuti" aria-selected="false">Cuti</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="lainnya-tab" data-bs-toggle="tab" data-bs-target="#lainnya" type="button" role="tab" aria-controls="lainnya" aria-selected="false">Lainnya</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="sakit" role="tabpanel" aria-labelledby="sakit-tab">
                                <div class="list-group mt-3">
                                    @foreach($pengajuanIzin as $izin)
                                        @if($izin->tipe_izin == 'S') <!-- Pastikan hanya menampilkan izin sakit -->
                                            <div class="list-group-item">
                                                <p><strong>Pengajuan : </strong> {{ \Carbon\Carbon::parse($izin->created_at)->format('l, d F Y, H:i') }}</p>
                                                <p><strong>Nama : </strong>{{ $izin->nama }}</p>
                                                <p><strong>Tanggal : </strong>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}
                                                <p><strong>Alasan : </strong>{{ $izin->alasan_izin }}</p>
                                                <p><strong>Lampiran : </strong>
                                                    @if($izin->lampiran)
                                                        <a href="{{ asset('storage/' . $izin->lampiran) }}" target="_blank">
                                                            <img src="{{ asset('storage/' . $izin->lampiran) }}" alt="Lampiran" style="width: 100px; height: 100px; object-fit: cover;">
                                                        </a>
                                                    @else
                                                        Tidak ada lampiran
                                                    @endif
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                <button class="btn btn-success">Dizinkan</button>
                                                <button class="btn btn-danger" type="submit">Ditolak</button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="tab-pane fade" id="cuti" role="tabpanel" aria-labelledby="cuti-tab">
                                <div class="list-group mt-3">
                                    @foreach($pengajuanIzin as $izin)
                                        @if($izin->tipe_izin == 'C')
                                            <div class="list-group-item">
                                                <p><strong>Pengajuan : </strong> {{ \Carbon\Carbon::parse($izin->created_at)->format('l, d F Y, H:i') }}</p>
                                                <p><strong>Nama : </strong>{{ $izin->nama }}</p>
                                                <p><strong>Tanggal : </strong>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</p>
                                                <p><strong>Alasan : </strong>{{ $izin->alasan_izin }}</p>
                                                <p><strong>Lampiran : </strong>
                                                    @if($izin->lampiran)
                                                        <a href="{{ asset('storage/' . $izin->lampiran) }}" target="_blank">
                                                            <img src="{{ asset('storage/' . $izin->lampiran) }}" alt="Lampiran" style="width: 100px; height: 100px; object-fit: cover;">
                                                        </a>
                                                    @else
                                                        Tidak ada lampiran
                                                    @endif
                                                </p>
                                                    <div class="d-flex justify-content-between">
                                                    <button class="btn btn-success">Dizinkan</button>
                                                    <button class="btn btn-danger">Ditolak</button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="tab-pane fade" id="lainnya" role="tabpanel" aria-labelledby="lainnya-tab">
                                <div class="list-group mt-3">
                                    @foreach($pengajuanIzin as $izin)
                                        @if($izin->tipe_izin == 'L') <!-- Pastikan hanya menampilkan izin lainnya -->
                                            <div class="list-group-item">
                                                <p><strong>Pengajuan : </strong> {{ \Carbon\Carbon::parse($izin->created_at)->format('l, d F Y, H:i') }}</p>
                                                <p><strong>Nama : </strong>{{ $izin->nama }}</p>
                                                <p><strong>Tanggal : </strong>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</p>
                                                <p><strong>Alasan : </strong>{{ $izin->alasan_izin }}</p>
                                                <p><strong>Lampiran : </strong>
                                                    @if($izin->lampiran)
                                                        <a href="{{ asset('/storage' . $izin->lampiran) }}" target="_blank">
                                                            <img src="{{ asset('/storage' . $izin->lampiran) }}" alt="Lampiran" style="width: 100px; height: 100px; object-fit: cover;">
                                                        </a>
                                                    @else
                                                        Tidak ada lampiran
                                                    @endif
                                                </p>                                                <div class="d-flex justify-content-between">
                                                    <button class="btn btn-success">Dizinkan</button>
                                                    <button class="btn btn-danger">Ditolak</button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
        
    </div>
@endsection
