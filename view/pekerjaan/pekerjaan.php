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
        <h2>Data Pekerjaan</h2>
        <a href="tambah.php" style="display: inline-block; padding: 10px 20px; border-radius: 4px; border: 2px solid #fb4f14; background: #fb4f14; color: #fff; text-decoration: none; font-weight: 600; margin-bottom: 10px;">Tambah Data</a>
        <a href="cetak.php" style="display: inline-block; padding: 10px 20px; border-radius: 4px; border: 2px solid #fb4f14; background: #fb4f14; color: #fff; text-decoration: none; font-weight: 600; margin-bottom: 10px;">Cetak</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jenis Pekerjaan</th>
                    <th>Sektor</th>
                    <th>Penghasilan</th>
                    <th>NIK</th>
                    <th>Status Pekerjaan</th>
                    <!-- <th>Deskripsi</th> -->
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../../koneksi.php';

                $sql = "SELECT id, nama, jenis_pekerjaan, sektor, penghasilan, nik, status_pekerjaan, deskripsi, foto FROM pekerjaan";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["jenis_pekerjaan"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["sektor"]) . "</td>";
                        echo "<td>Rp. " . htmlspecialchars($row["penghasilan"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["nik"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["status_pekerjaan"]) . "</td>";
                        // echo "<td>" . htmlspecialchars($row["deskripsi"]) . "</td>";

                        if ($row["foto"]) {
                            echo '<td><img src="data:image/jpeg;base64,' . htmlspecialchars($row["foto"]) . '" width="100" height="100"></td>';
                        } else {
                            echo '<td>Tidak ada foto</td>';
                        }

                        echo "<td>";
                        echo '<a class="bt_detail" href="detail.php?id=' . htmlspecialchars($row["id"]) . '"><img src="../aset/see.png" alt="Lihat" width="20" height="20"></a> ';
                        echo '<a class="bt_edit" href="edit.php?id=' . htmlspecialchars($row["id"]) . '"><img src="../aset/edit.png" alt="Edit" width="20" height="20"></a> ';
                        echo '<a class="bt_hapus" href="hapus.php?id=' . htmlspecialchars($row["id"]) . '" onclick="return confirm(\'Anda yakin ingin menghapus data ini?\')"><img src="../aset/delete.png" alt="Hapus" width="20" height="20"></a>';
                        echo "</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Tidak ada data</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>
</html>
