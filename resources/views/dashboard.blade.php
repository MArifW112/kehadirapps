@extends('layouts.layout')

@section('title', 'Dashboard Kehadiran')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow card-custom">
                <div class="card-header">
                    <h4>Rekap Absensi Hari Ini</h4>
                    <p>Minggu, 25 Agustus 2025 10:00 WIB</p>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="startTime">Jam Kerja:</label>
                            <input type="time" class="form-control" id="startTime">
                        </div>
                        <div class="col-md-6">
                            <label for="endTime">Jam Kerja:</label>
                            <input type="time" class="form-control" id="endTime">
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Jumlah Karyawan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Hadir</td>
                                <td>{{ $hadirCount }} Karyawan</td>
                            </tr>
                            <tr>
                                <td>Tidak Hadir</td>
                                <td>{{ $hadirCount }} Karyawan</td>
                            </tr>
                            <tr>
                                <td>Libur</td>
                                <td>{{$pCount}} Karyawan</td>
                            </tr>
                            <tr>
                                <td>Izin</td>
                                <td>{{ $liburCount }} Karyawan</td>
                            </tr>
                            <tr>
                                <td>Sakit</td>
                                <td>5 Karyawan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
