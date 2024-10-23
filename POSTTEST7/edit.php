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
$maxfilesize = 500 * 1024;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $tanggal = $_POST['tanggal'];
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $tulisan = $_POST['tulisan'];
    
    $file_name = $_FILES["gambar"]["name"];
    $tmp_name = $_FILES["gambar"]["tmp_name"];
    $ekstensi = explode('.', $file_name);
    $ekstensi = end($ekstensi);
    $newFileName = date('Y-m-d H.i.s') . '.' . $ekstensi;
    if ($_FILES["gambar"]["size"] > $maxfilesize){
        echo "<script> alert('Ukuran file terlalu besar. Batas maksimal 500 KB.'); </script>";
    }else{
        if (move_uploaded_file($tmp_name, 'img/' . $newFileName)) {
            $sql = "UPDATE tantangan 
                    SET tanggal = '$tanggal',
                        email = '$email',
                        nama = '$nama',
                        tulisan = '$tulisan',
                        gambar = '$newFileName'
                    WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Tantangan berhasil diupdate!'); window.location.href='index.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        } else {
            echo "<script>alert('Gagal mengunggah gambar!');</script>";
        }
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
    <style>
    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #ff6347;
        color: white;
        border: none;
        border-radius: 5px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 20px;
    }

    .btn:hover {
        background-color: #ffa500;
    }

    .btn:active {
        background-color: #3e8e41;
        transform: scale(0.98);
    }
</style>

</head>
<body>
    <div class="container">
        <h1>Edit Tantangan</h1>
        <form method="POST" action="edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
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

            <div class="input">
                <label for="gambar">Unggah Gambar Baru:</label>
                <input type="file" id="gambar" name="gambar" required>
                <?php if ($row['gambar'] != ""): ?>
                    <p>Gambar Saat Ini: <img src="img/<?php echo $row['gambar']; ?>" width="50" height="50"></p>
                <?php endif; ?>
            </div>

            <input type="submit" class="button" value="Update Tantangan" name="update">
        </form>
        <div class="link">
            <button class="btn" onclick="window.location.href='index.php'">Kembali ke Daftar Tantangan</button>
        </div>
    </div>
</body>
</html>
