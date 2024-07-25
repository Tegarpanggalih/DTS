<?php
// Include database connection file
require_once '../../koneksi.php';

// Check if the id parameter is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Mengambil id dari parameter URL dan mengonversi ke integer

    // Persiapkan query SQL untuk menghapus data berdasarkan id
    $sql = "DELETE FROM pekerjaan WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect ke halaman pekerjaan.php setelah berhasil menghapus data
        header("Location: pekerjaan.php?success=1");
        exit(); // Pastikan script berhenti setelah redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID tidak ditemukan.";
}

$conn->close();
?>
