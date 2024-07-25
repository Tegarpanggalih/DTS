<?php
// Include database connection file
require_once '../../koneksi.php';

// Check if the id parameter is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Mengambil id dari parameter URL dan mengonversi ke integer

    // Persiapkan query SQL untuk mengambil data berdasarkan id
    $sql = "SELECT * FROM pekerjaan WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Eksekusi query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }

    $stmt->close();
} else {
    echo "ID tidak ditemukan.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pekerjaan</title>
    <link rel="stylesheet" href="../../styles.css">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@300&display=swap" rel="stylesheet">
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
        <h2>Detail Pekerjaan</h2>
        <div class="form">
            <div class="form-group">
                <label>Nama:</label>
                <p><?php echo htmlspecialchars($row['nama']); ?></p>
            </div>
            <div class="form-group">
                <label>Jenis Pekerjaan:</label>
                <p><?php echo htmlspecialchars($row['jenis_pekerjaan']); ?></p>
            </div>
            <div class="form-group">
                <label>Sektor:</label>
                <p><?php echo htmlspecialchars($row['sektor']); ?></p>
            </div>
            <div class="form-group">
                <label>Penghasilan:</label>
                <p><?php echo htmlspecialchars($row['penghasilan']); ?></p>
            </div>
            <div class="form-group">
                <label>NIK:</label>
                <p><?php echo htmlspecialchars($row['nik']); ?></p>
            </div>
            <div class="form-group">
                <label>Status Pekerjaan:</label>
                <p><?php echo htmlspecialchars($row['status_pekerjaan']); ?></p>
            </div>
            <div class="form-group">
                <label>Deskripsi:</label>
                <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
            </div>
            <div class="form-group">
                <label>Foto:</label>
                <?php if (!empty($row['foto'])): ?>
                    <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($row['foto']); ?>" width="200" height="200" alt="Foto">
                <?php else: ?>
                    <p>Tidak ada foto</p>
                <?php endif; ?>
            </div>
            <a class="button" href="pekerjaan.php" style="display: inline-block; padding: 10px 20px; border-radius: 4px; border: 2px solid #fb4f14; background: #fb4f14; color: #fff; text-decoration: none; font-weight: 600;">Kembali</a>
        </div>
    </div>

</body>
</html>
