@extends('layouts.layout')

@section('title', 'Dashboard Kehadiran')

@section('content')
    <div class="container">
        <h4>Jam Kerja</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Masuk</th>
                    <th>Pulang</th>
                    <th>Minimal Absensi Masuk</th>
                    <th>Maksimal Absensi Pulang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Senin</td>
                    <td><input type="time" class="form-control" value="08:00"></td>
                    <td><input type="time" class="form-control" value="16:00"></td>
                    <td><input type="time" class="form-control" value="06:00"></td>
                    <td><input type="time" class="form-control" value="17:00"></td>
                    <td>
                        <input type="radio" name="liburSenin"> Libur
                        <button class="btn btn-sm btn-primary">Edit</button>
                    </td>
                </tr>
                <tr>
                    <td>Selasa</td>
                    <td>08:00</td>
                    <td>16:00</td>
                    <td>06:00</td>
                    <td>17:00</td>
                    <td>
                        <input type="radio" name="liburSelasa"> Libur
                        <button class="btn btn-sm btn-primary">Edit</button>
                    </td>
                </tr>
                <tr>
                    <td>Rabu</td>
                    <td>08:00</td>
                    <td>16:00</td>
                    <td>06:00</td>
                    <td>17:00</td>
                    <td>
                        <input type="radio" name="liburRabu"> Libur
                        <button class="btn btn-sm btn-primary">Edit</button>
                    </td>
                </tr>
                <tr>
                    <td>Kamis</td>
                    <td>08:00</td>
                    <td>16:00</td>
                    <td>06:00</td>
                    <td>17:00</td>
                    <td>
                        <input type="radio" name="liburKamis"> Libur
                        <button class="btn btn-sm btn-primary">Edit</button>
                    </td>
                </tr>
                <tr>
                    <td>Jum'at</td>
                    <td>08:00</td>
                    <td>16:00</td>
                    <td>06:00</td>
                    <td>17:00</td>
                    <td>
                        <input type="radio" name="liburJumat"> Libur
                        <button class="btn btn-sm btn-primary">Edit</button>
                    </td>
                </tr>
                <tr>
                    <td>Sabtu</td>
                    <td>08:00</td>
                    <td>16:00</td>
                    <td>06:00</td>
                    <td>17:00</td>
                    <td>
                        <input type="radio" name="liburSabtu"> Libur
                        <button class="btn btn-sm btn-primary">Edit</button>
                    </td>
                </tr>
                <tr>
                    <td>Minggu</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                        <span class="status-libur">LIBUR</span>
                        <button class="btn btn-sm btn-primary">Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-success float-right">Simpan</button>
    </div>
@endsection
