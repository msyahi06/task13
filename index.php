<?php
// Konfigurasi koneksi database
$servername = "localhost";
$username = "root"; // sesuaikan dengan username MySQL kamu
$password = ""; // sesuaikan dengan password MySQL kamu
$dbname = "tugas13"; // sesuaikan dengan nama database kamu

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangani pencarian
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM sepatu WHERE title LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM sepatu";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar URL</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Daftar URL</h2>

    <form method="get" action="">
        <input type="text" name="search" placeholder="Cari berdasarkan title..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Cari</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>URL</th>
            <th>Description</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data untuk setiap baris
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . htmlspecialchars($row["TITLE"]) . "</td>";
                echo "<td><a href='" . htmlspecialchars($row["URL"]) . "'>" . htmlspecialchars($row["URL"]) . "</a></td>";
                echo "<td>" . htmlspecialchars($row["DESCRIPTION"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data yang ditemukan</td></tr>";
        }
        ?>
    </table>

    <?php
    // Menutup koneksi
    $conn->close();
    ?>
</body>
</html>
