<?php
// Include database connection file
require_once '../../koneksi.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jenis_pekerjaan = $_POST['jenis_pekerjaan'];
    $sektor = $_POST['sektor'];
    $penghasilan = $_POST['penghasilan']; // Penghasilan sudah dihitung di sisi klien
    $nik = $_POST['nik'];
    $status_pekerjaan = $_POST['status_pekerjaan'];
    $deskripsi = $_POST['deskripsi'];
    $jam_kerja = $_POST['jam_kerja'];
    $upah_per_jam = $_POST['upah_per_jam'];

    // Proses upload foto
    $foto = null; // Initialize foto variable
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fileTmpPath = $_FILES['foto']['tmp_name'];
        $fileData = file_get_contents($fileTmpPath);
        $foto = base64_encode($fileData);
    }

    // Persiapkan query SQL
    $sql = "INSERT INTO pekerjaan (nama, jenis_pekerjaan, sektor, penghasilan, nik, status_pekerjaan, deskripsi, jam_kerja, upah_per_jam, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param(
        "sssddssdds", // Tipe data: s = string, d = double
        $nama,
        $jenis_pekerjaan,
        $sektor,
        $penghasilan,
        $nik,
        $status_pekerjaan,
        $deskripsi,
        $jam_kerja,
        $upah_per_jam,
        $foto
    );

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect to pekerjaan.php
        header("Location: pekerjaan.php?success=1");
        exit(); // Pastikan script berhenti setelah redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
