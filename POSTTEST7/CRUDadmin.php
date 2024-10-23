<?php
session_start();
$host = 'localhost'; 
$user = 'root'; 
$password = ''; 
$dbname = 'writing_challenge'; 

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit;
}

$query = "SELECT * FROM tantangan";

$searchPerformed = false;

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $keyword = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM tantangan WHERE nama LIKE '%$keyword%' OR tulisan LIKE '%$keyword%'";
    $searchPerformed = true;
}

$result = mysqli_query($conn, $query);
$totalResults = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Admin - Daftar Tantangan</title>
    <link rel="stylesheet" href="styletantangan.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Tantangan Penulisan</h1>

        <form action="CRUDadmin.php" method="GET">
            <input type="text" name="keyword" placeholder="Cari berdasarkan Nama atau Tulisan..." required>
            <button type="submit">Cari</button>
        </form>

        <?php if ($searchPerformed): ?>
            <p>Hasil pencarian untuk: <strong><?= $keyword; ?></strong></p>
            <p>Total hasil ditemukan: <?= $totalResults; ?></p>
        <?php endif; ?>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Tulisan</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($totalResults > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['tanggal']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['tulisan']; ?></td>
                            <td>
                                <center>
                                    <?php if ($row['gambar']): ?>
                                        <img src="img/<?= $row['gambar']; ?>" alt="gambar" width="50" height="50">
                                    <?php else: ?>
                                        Foto belum ada
                                    <?php endif; ?>
                                </center>
                            </td>
                            <td>
                                <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
                                <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Tidak ada tantangan yang ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <p>
            <a href="logout.php">Logout</a>
        </p>
    </div>

    <style>
        button:hover {
            background-color: #555;
            color: white;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        a:hover {
            color: red;
            cursor: pointer;
        }
    </style>
</body>
</html>

<?php
mysqli_close($conn);
?>
