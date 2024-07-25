<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pekerjaan</title>
    <link rel="stylesheet" href="../../styles.css">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@300&display=swap" rel="stylesheet">
    <script>
        function updatePenghasilan() {
            // Ambil nilai jam kerja dan upah per jam
            var jamKerja = parseFloat(document.getElementById('jam_kerja').value);
            var upahPerJam = parseFloat(document.getElementById('upah_per_jam').value);

            // Hitung penghasilan
            if (!isNaN(jamKerja) && !isNaN(upahPerJam)) {
                var penghasilan = jamKerja * upahPerJam;
                document.getElementById('penghasilan').value = penghasilan.toFixed(2);
            }
        }

        function validnik() {
            var nik = document.getElementById('nik').value;
            if (nik.length !== 16) {
                alert('NIK harus terdiri dari 16 karakter.');
            }
        }
    </script>
</head>
<body>

<header>
    <div>
        <a href="#" class="firstname">Boyo</a>
        <a href="#" class="lastname">Hub</a>
    </div>
    <nav class="navigation">
        <a href="../../index.php">Home</a>
        <a href="pekerjaan.php">Pekerjaan</a>
        <a href="#">Penduduk</a>
        <a href="#">Keluarga</a>
    </nav>
</header>

<div class="content">
    <h2>Tambah Pekerjaan</h2>
    <form action="proses_tambah.php" method="POST" enctype="multipart/form-data" class="form">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="jenis_pekerjaan">Jenis Pekerjaan:</label>
            <input type="text" id="jenis_pekerjaan" name="jenis_pekerjaan" required>
        </div>
        <div class="form-group">
            <label for="sektor">Sektor:</label>
            <select id="sektor" name="sektor" required>
                <option value="">Pilih Sektor</option>
                <option value="Pemerintahan">Pemerintahan</option>
                <option value="Swasta">Swasta</option>
                <option value="Wirausaha">Wirausaha</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="form-group">
            <label for="jam_kerja">Jam Kerja:</label>
            <select id="jam_kerja" name="jam_kerja" required onchange="updatePenghasilan()">
                <option value="">Pilih Jam Kerja</option>
                <option value="1">1 Jam</option>
                <option value="2">2 Jam</option>
                <option value="3">3 Jam</option>
                <option value="4">4 Jam</option>
                <option value="5">5 Jam</option>
                <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
            </select>
        </div>
        <div class="form-group">
            <label for="upah_per_jam">Upah per Jam:</label>
            <input type="number" id="upah_per_jam" name="upah_per_jam" step="0.01" required onchange="updatePenghasilan()">
        </div>
        <div class="form-group">
            <label for="penghasilan">Penghasilan:</label>
            <input type="number" id="penghasilan" name="penghasilan" readonly>
        </div>
        <div class="form-group">
            <label for="nik">NIK:</label>
            <input type="number" id="nik" name="nik" required onchange="validnik()">
        </div>
        <div class="form-group">
            <label for="status_pekerjaan">Status Pekerjaan:</label>
            <select id="status_pekerjaan" name="status_pekerjaan" required>
                <option value="">Pilih Status</option>
                <option value="Tetap">Tetap</option>
                <option value="Kontrak">Kontrak</option>
                <option value="Freelance">Freelance</option>
            </select>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto" accept="image/*" required>
        </div>
        <button type="submit">Tambah</button>
    </form>
</div>

</body>
</html>
