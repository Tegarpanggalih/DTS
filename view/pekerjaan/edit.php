<?php
require_once '../../koneksi.php';

// Ambil ID dari parameter URL
$id = $_GET['id'];

// Query untuk mengambil data pekerjaan berdasarkan ID
$sql = "SELECT * FROM Pekerjaan WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pekerjaan</title>
    <link rel="stylesheet" href="../../styles.css">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@300&display=swap" rel="stylesheet">
    <script>
        function updatePenghasilan() {
            var jamKerja = parseFloat(document.getElementById('jam_kerja').value);
            var upahPerJam = parseFloat(document.getElementById('upah_per_jam').value);

            if (!isNaN(jamKerja) && !isNaN(upahPerJam)) {
                var penghasilan = jamKerja * upahPerJam;
                document.getElementById('penghasilan').value = penghasilan.toFixed(2);
            }
        }

        function validnik(){
            var nik = document.getElementById('nik').value;
            if (nik.length !== 16) {
                alert('NIK harus terdiri dari 16 karakter.');
            }
        }
    </script>
</head>
<body>

    <<header>
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
        <h2>Edit Pekerjaan</h2>
        <form action="proses_edit.php" method="POST" enctype="multipart/form-data" class="form">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jenis_pekerjaan">Jenis Pekerjaan:</label>
                <input type="text" id="jenis_pekerjaan" name="jenis_pekerjaan" value="<?php echo $row['jenis_pekerjaan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="sektor">Sektor:</label>
                <select id="sektor" name="sektor" required>
                    <option value="">Pilih Sektor</option>
                    <option value="Pemerintahan" <?php if ($row['sektor'] == 'Pemerintahan') echo 'selected'; ?>>Pemerintahan</option>
                    <option value="Swasta" <?php if ($row['sektor'] == 'Swasta') echo 'selected'; ?>>Swasta</option>
                    <option value="Wirausaha" <?php if ($row['sektor'] == 'Wirausaha') echo 'selected'; ?>>Wirausaha</option>
                    <option value="Lainnya" <?php if ($row['sektor'] == 'Lainnya') echo 'selected'; ?>>Lainnya</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jam_kerja">Jam Kerja:</label>
                <select id="jam_kerja" name="jam_kerja" required onchange="updatePenghasilan()">
                    <option value="">Pilih Jam Kerja</option>
                    <option value="1" <?php if ($row['jam_kerja'] == 1) echo 'selected'; ?>>1 Jam</option>
                    <option value="2" <?php if ($row['jam_kerja'] == 2) echo 'selected'; ?>>2 Jam</option>
                    <option value="3" <?php if ($row['jam_kerja'] == 3) echo 'selected'; ?>>3 Jam</option>
                    <option value="4" <?php if ($row['jam_kerja'] == 4) echo 'selected'; ?>>4 Jam</option>
                    <option value="5" <?php if ($row['jam_kerja'] == 5) echo 'selected'; ?>>5 Jam</option>
                    <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                </select>
            </div>
            <div class="form-group">
                <label for="upah_per_jam">Upah per Jam:</label>
                <input type="number" id="upah_per_jam" name="upah_per_jam" step="0.01" value="<?php echo $row['upah_per_jam']; ?>" required onchange="updatePenghasilan()">
            </div>
            <div class="form-group">
                <label for="penghasilan">Penghasilan:</label>
                <input type="number" id="penghasilan" name="penghasilan" value="<?php echo $row['penghasilan']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="number" id="nik" name="nik" value="<?php echo $row['nik']; ?>" required onchange="validnik()">
            </div>
            <div class="form-group">
                <label for="status_pekerjaan">Status Pekerjaan:</label>
                <select id="status_pekerjaan" name="status_pekerjaan" required>
                    <option value="">Pilih Status</option>
                    <option value="Tetap" <?php if ($row['status_pekerjaan'] == 'Tetap') echo 'selected'; ?>>Tetap</option>
                    <option value="Kontrak" <?php if ($row['status_pekerjaan'] == 'Kontrak') echo 'selected'; ?>>Kontrak</option>
                    <option value="Freelance" <?php if ($row['status_pekerjaan'] == 'Freelance') echo 'selected'; ?>>Freelance</option>
                </select>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required><?php echo $row['deskripsi']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" id="foto" name="foto" accept="image/*">
            </div>
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>

</body>
</html>
