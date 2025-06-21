@extends('layouts.layout')

@section('title', 'Dashboard Kehadiran')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan Absensi</h4>
                    </div>
                    <div class="card-body">
                        <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Absensi Masuk</th>
                                    <th>Absensi Keluar</th>
                                    <th>Istirahat Mulai</th>
                                    <th>Istirahat Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($absensis as $absensi)
                                <tr> 
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $absensi->tanggal }}</td>
                                    <td>{{ $absensi->nama }}</td>
                                    <td>{{ $absensi->absensi_masuk }}</td>
                                    <td>{{ $absensi->absensi_keluar }}</td>
                                    <td>{{ $absensi->istirahat_mulai }}</td>
                                    <td>{{ $absensi->istirahat_selesai }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inisialisasi DataTable -->
    <script>
        $(document).ready(function() {
            $('#tabel-data').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                language: {
                    "emptyTable": "Tidak ada data yang tersedia",
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });
    </script>
@endsection
