@extends('layouts.layout')

@section('title', 'Dashboard Kehadiran')

@section('content')
    <style>
        .btn-open-popup {
            padding: 12px 24px;
            font-size: 18px;
            background-color: green;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-open-popup:hover {
            background-color: #4caf50;
        }

        .overlay-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .popup-box {
            background: #ffffff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
            width: 320px;
            text-align: center;
            opacity: 0;
            transform: scale(0.8);
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .form-container {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            margin-bottom: 10px;
            font-size: 16px;
            color: #444;
            text-align: left;
        }

        .form-input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-submit,
        .btn-close-popup {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-submit {
            background-color: green;
            color: #fff;
        }

        .btn-close-popup {
            margin-top: 12px;
            background-color: #e74c3c;
            color: #fff;
        }

        .btn-submit:hover,
        .btn-close-popup:hover {
            background-color: #1e2896;
        }

        /* Keyframes for fadeInUp animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animation for popup */
        .overlay-container.show {
            display: flex;
            opacity: 1;
        }
    </style>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Hari Libur Nasional</h4>
                <p>Tahun 2024 - 2025</p>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="liburTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="daftar-tab" data-bs-toggle="tab" data-bs-target="#daftar" type="button" role="tab" aria-controls="daftar" aria-selected="true">Daftar Tabel</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="kalender-tab" data-bs-toggle="tab" data-bs-target="#kalender" type="button" role="tab" aria-controls="kalender" aria-selected="false">Kalender</button>
                    </li>
                </ul>

                <div class="tab-content" id="liburTabContent">
                    <div class="tab-pane fade show active" id="daftar" role="tabpanel" aria-labelledby="daftar-tab">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hariliburs as $harilibur)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $harilibur->tanggal }}</td>
                                    <td>{{ $harilibur->keterangan_libur }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="editData('{{ $harilibur->id_libur }}', '{{ $harilibur->tanggal }}', '{{ $harilibur->keterangan_libur }}')">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteData('{{ $harilibur->id_libur }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="kalender" role="tabpanel" aria-labelledby="kalender-tab">
                        <p class="mt-3">Kalender Hari Libur will be available soon...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popup button -->
        <button class="btn btn-primary" onclick="togglePopup()">Tambah Data</button>

        <!-- Popup form Tambah Data -->
        <div id="popupOverlay" class="overlay-container">
            <div class="popup-box">
                <h2 style="color: rgb(0, 0, 0);">Data Hari Libur</h2>
                <form class="form-container" method="POST" action="{{ route('harilibur.store') }}">
                    @csrf  <!-- Token CSRF untuk keamanan -->
                    <label class="form-label" for="tanggal">Tanggal</label>
                    <input class="form-input" type="date" id="tanggal" name="tanggal" required>
                
                    <label class="form-label" for="keterangan_libur">Keterangan</label>
                    <input class="form-input" type="text" placeholder="Masukan Keterangan Libur" id="keterangan_libur" name="keterangan_libur" required>
                
                    <button class="btn-submit" type="submit">Tambahkan Data</button>
                </form>
                <button class="btn-close-popup" onclick="togglePopup()">Tutup</button>
            </div>
        </div>
</div>

      <!-- Popup form untuk edit data -->
      <div id="editPopupOverlay" class="overlay-container">
        <div class="popup-box">
            <h2 style="color: rgb(0, 0, 0);">Edit Data Hari Libur</h2>
            <form class="form-container" method="POST" id="editForm">
                @csrf
                @method('PUT') <!-- Spoofing method PUT -->
            
                <label class="form-label" for="editTanggal">Tanggal</label>
                <input class="form-input" type="date" id="editTanggal" name="tanggal" required>
            
                <label class="form-label" for="editKeterangan_libur">Keterangan</label>
                <input class="form-input" type="text" placeholder="Masukan Keterangan Libur" id="editKeterangan_libur" name="keterangan_libur" required>
            
                <button class="btn-submit" type="submit">Simpan Perubahan</button>
            </form>
            
            <button class="btn-close-popup" onclick="toggleEditPopup()">Tutup</button>
        </div>
    </div>
    
<!-- Popup konfirmasi hapus -->
<div id="deleteOverlay" class="overlay-container">
    <div class="popup-box">
        <h2 style="color: rgb(0, 0, 0);">Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus data ini?</p>
        <button class="btn-submit" id="confirmDeleteBtn">Ya, Hapus</button>
        <button class="btn-close-popup" onclick="toggleDeletePopup()">Batal</button>
    </div>
</div>

    <script>
    function togglePopup() {
            const overlay = document.getElementById('popupOverlay');
            overlay.classList.toggle('show');
        }
    </script>
    <script>
        function toggleEditPopup() {
            const overlay = document.getElementById('editPopupOverlay');
            overlay.classList.toggle('show');
            console.log('Popup edit toggled'); // Debugging
        }
        
        function editData(id_libur, tanggal, keterangan) {
            // Mengisi nilai form dengan data yang akan diedit
            document.getElementById('editTanggal').value = tanggal;
            document.getElementById('editKeterangan_libur').value = keterangan;
        
            // Ubah action form menjadi URL update dengan id_libur
            const form = document.getElementById('editForm');
            form.action = `/harilibur/update/${id_libur}`; // Pastikan ini mengarah ke route yang benar
        
            // Tampilkan popup
            toggleEditPopup();
        }
        </script>

    <script>
        let deleteIdLibur; // Variabel untuk menyimpan ID libur yang akan dihapus

function toggleDeletePopup() {
    const overlay = document.getElementById('deleteOverlay');
    overlay.classList.toggle('show');
}

function deleteData(id_libur) {
    deleteIdLibur = id_libur; // Simpan ID libur yang akan dihapus
    toggleDeletePopup(); // Tampilkan popup konfirmasi
}

// Event listener untuk tombol konfirmasi hapus
document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    // Mengarahkan ke route delete menggunakan id_libur
    window.location.href = `/harilibur/delete/${deleteIdLibur}`; // Ubah sesuai dengan route delete Anda
});

    </script>
@endsection
