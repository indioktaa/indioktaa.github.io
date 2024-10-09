<?php
$host = 'localhost'; 
$user = 'root'; 
$password = ''; 
$dbname = 'writing_challenge'; 
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $tanggal = $_POST['tanggal'];
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $tulisan = $_POST['tulisan'];

    $sql = "UPDATE tantangan SET tanggal='$tanggal', email='$email', nama='$nama', tulisan='$tulisan' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Tantangan berhasil diupdate!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM tantangan WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tantangan</title>
    <link rel="stylesheet" href="styletantangan.css">
</head>
<body>
    <div class="container">
        <h1>Edit Tantangan</h1>
        <form method="POST" action="edit.php?id=<?php echo $id; ?>">
            <div class="input">
                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
            </div>

            <div class="input">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>

            <div class="input">
                <label for="nama">Nama Penulis:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
            </div>

            <div class="input">
                <label for="tulisan">Isi Tantangan:</label>
                <textarea id="tulisan" name="tulisan" rows="6" required><?php echo $row['tulisan']; ?></textarea>
            </div>

            <input type="submit" class="button" value="Update Tantangan" name="update">
        </form>
        <div class="link">
            <button class="btn" onclick="window.location.href='index.php'">Kembali ke Daftar Tantangan</button>
        </div>
    </div>
</body>
</html>
