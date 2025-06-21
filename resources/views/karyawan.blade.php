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
    z-index: 9999; /* Tingkatkan z-index */
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Karyawan</h4>
                    </div>
                    <div class="card-body">
                        <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($karyawans as $karyawans)
                                <tr> 
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $karyawans->nama_karyawan}}</td>
                                    <td>{{ $karyawans->alamat }}</td>
                                    <td>{{ $karyawans->email }}</td>
                                    <td>{{ $karyawans->no_hp }}</td>
                                    <td>{{ $karyawans->jabatan }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="editData('{{ $karyawans->user_id }}', '{{ $karyawans->nama_karyawan }}','{{ $karyawans->alamat }}','{{ $karyawans->email }}','{{ $karyawans->no_hp }}','{{ $karyawans->jabatan }}')">
                                            <i class="bi bi-pencil-square"></i>

                                            <button class="btn btn-danger btn-sm" onclick="deleteData('{{ $karyawans->user_id }}')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            </form> 
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-success" onclick="togglePopup()">Tambah Karyawan</button>


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

<script>
    function togglePopup() {
    const overlay = document.getElementById('popupOverlay');
    overlay.classList.toggle('show');
}
</script>
<!-- Popup form Tambah Data -->
<div id="popupOverlay" class="overlay-container">
    <div class="popup-box">
        <h2 style="color: rgb(0, 0, 0);">Tambah Data Karyawan</h2>
        <form class="form-container" method="POST" action="{{ route('karyawan.store') }}">
            @csrf  <!-- Token CSRF untuk keamanan -->
        
            <label class="form-label" for="nama_karyawan">Nama Karyawan</label>
            <input class="form-input" type="text" id="nama_karyawan" name="nama_karyawan" required>
        
            <label class="form-label" for="alamat">Alamat</label>
            <input class="form-input" type="text" id="alamat" name="alamat" required>
        
            <label class="form-label" for="email">Email</label>
            <input class="form-input" type="email" id="email" name="email" required>

            <label class="form-label" for="password">Password</label>
            <input class="form-input" type="password" id="password" name="password" required 
                pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" 
                title="Password harus terdiri dari minimal 8 karakter dan mengandung kombinasi angka dan huruf.">
                <p class="password-description" style="font-size: 12px; color: #777;">Password harus terdiri dari minimal 8 
                karakter dan mengandung kombinasi angka dan huruf.</p>

            <label class="form-label" for="no_hp">No HP</label>
            <input class="form-input" type="text" id="no_hp" name="no_hp" required>

            <label class="form-label" for="jabatan">Jabatan</label>
            <input class="form-input" type="text" id="jabatan" name="jabatan" required>

            <button class="btn-submit" type="submit">Tambah Data</button>
        </form>
        <button class="btn-close-popup" onclick="togglePopup()">Tutup</button>
    </div>
</div>

        <!-- Popup form Edit -->
<div id="editPopupOverlay" class="overlay-container">
    <div class="popup-box">
        <h2 style="color: rgb(0, 0, 0);">Edit Data Karyawan</h2>
        <form class="form-container" method="POST" id="editForm">
            @csrf
            @method('PUT')
        
            <label class="form-label" for="editNama">Edit Nama</label>
            <input class="form-input" type="text" id="editNama" name="nama_karyawan" required>
        
            <label class="form-label" for="editAlamat">Alamat</label>
            <input class="form-input" type="text" id="editAlamat" name="alamat" required>
        
            <label class="form-label" for="editEmail">Email</label>
            <input class="form-input" type="text" id="editEmail" name="email" required>

            <label class="form-label" for="editNoHP">No HP</label>
            <input class="form-input" type="text" id="editNoHP" name="no_hp" required>

            <label class="form-label" for="editJabatan">Jabatan</label>
            <input class="form-input" type="text" id="editJabatan" name="jabatan" required>

            <button class="btn-submit" type="submit">Simpan Perubahan</button>
        </form>
        
        <button class="btn-close-popup" onclick="toggleEditPopup()">Tutup</button>
    </div>
</div>

<!-- Popup konfirmasi hapus -->
<div id="deleteOverlay" class="overlay-container">
    <div class="popup-box">
        <h2>Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus data ini?</p>
        <button class="btn-submit" id="confirmDeleteBtn">Ya, Hapus</button>
        <button class="btn-close-popup" onclick="toggleDeletePopup()">Batal</button>
    </div>
</div>


    <script>
        function togglePopup() 
        {
                const overlay = document.getElementById('popupOverlay');
                overlay.classList.toggle('show');
        }
    </script>


    <script>
        function toggleEditPopup() {
    const overlay = document.getElementById('editPopupOverlay');
    if (overlay.classList.contains('show')) {
        overlay.classList.remove('show');
    } else {
        overlay.classList.add('show');
    }
}

function editData(user_id, nama_karyawan, alamat, email, no_hp, jabatan) {
    document.getElementById('editNama').value = nama_karyawan;
    document.getElementById('editAlamat').value = alamat;
    document.getElementById('editEmail').value = email;
    document.getElementById('editNoHP').value = no_hp;
    document.getElementById('editJabatan').value = jabatan;

    const form = document.getElementById('editForm');
    form.action = `/karyawan/update/${user_id}`;
    
    // Tampilkan popup
    toggleEditPopup();
}
    </script>

    <script>
let deleteIdUser; // Variabel untuk menyimpan ID karyawan yang akan dihapus

function toggleDeletePopup() {
    const overlay = document.getElementById('deleteOverlay');
    overlay.classList.toggle('show');
}

function deleteData(user_id) {
    deleteIdUser = user_id; // Simpan ID karyawan yang akan dihapus
    toggleDeletePopup(); // Tampilkan popup konfirmasi
}

// Event listener untuk tombol konfirmasi hapus
document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    const url = `/karyawan/${deleteIdUser}`; // URL untuk menghapus data karyawan
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = url;

    // Tambahkan CSRF token dan metode DELETE
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);

    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'DELETE';
    form.appendChild(methodInput);

    // Kirim form untuk menghapus data karyawan
    document.body.appendChild(form);
    form.submit();
});

    </script>