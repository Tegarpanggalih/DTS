<?php
require_once '../../koneksi.php';

// Ambil data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$jenis_pekerjaan = $_POST['jenis_pekerjaan'];
$sektor = $_POST['sektor'];
$penghasilan = $_POST['penghasilan'];
$nik = $_POST['nik'];
$status_pekerjaan = $_POST['status_pekerjaan'];
$deskripsi = $_POST['deskripsi'];

// Cek apakah ada file foto yang diupload
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    // Ambil detail file
    $fileTmpPath = $_FILES['foto']['tmp_name'];
    $fileName = $_FILES['foto']['name'];
    $fileSize = $_FILES['foto']['size'];
    $fileType = $_FILES['foto']['type'];

    // Baca file foto dan ubah menjadi base64
    $fileData = file_get_contents($fileTmpPath);
    $fileBase64 = base64_encode($fileData);

    // Update query dengan foto
    $sql = "UPDATE Pekerjaan SET 
                nama = '$nama', 
                jenis_pekerjaan = '$jenis_pekerjaan', 
                sektor = '$sektor', 
                penghasilan = $penghasilan, 
                nik = '$nik', 
                status_pekerjaan = '$status_pekerjaan', 
                deskripsi = '$deskripsi',
                foto = '$fileBase64'
            WHERE id = $id";
} else {
    // Update query tanpa foto
    $sql = "UPDATE Pekerjaan SET 
                nama = '$nama', 
                jenis_pekerjaan = '$jenis_pekerjaan', 
                sektor = '$sektor', 
                penghasilan = $penghasilan, 
                nik = '$nik', 
                status_pekerjaan = '$status_pekerjaan', 
                deskripsi = '$deskripsi'
            WHERE id = $id";
}

// Eksekusi query
if ($conn->query($sql) === TRUE) {
    echo "Data berhasil diperbarui";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Redirect kembali ke halaman data pekerjaan
header("Location: pekerjaan.php");
exit();
?>
