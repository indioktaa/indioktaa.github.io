<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayo Tingkatkan Kemampuan Menulis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="styletantangan.css">
</head>
<body>
<script text="text/javascript" src="script.js"></script>
    <div class="container">
        <h1 class="logo"><i class="fa-sharp fa-solid fa-pencil"></i> Ayo Selesaikan Tantangan</h1>
        
        <p id="tema-tantangan">Tema Tantangan: <span id="tema">Tema akan ditampilkan di sini</span></p>
        
        <h2 class="form-title">Mulai Tantangan Hari Ini</h2>
        
        <form id="form-tantangan" method="POST" action="index.php">
            <div class="input">
                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" required>
            </div>

            <div class="input">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email" required>
            </div>

            <div class="input">
                <label for="nama">Nama Penulis:</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama penulis" required>
            </div>

            <div class="input">
                <label for="tulisan">Isi Tantangan:</label>
                <textarea id="tulisan" name="tulisan" placeholder="Tulis di sini. . ." rows="6" required></textarea>
            </div>

            <input type="submit" class="button" value="Kirim Tantangan" name="kirim">  
        </form>

        <h2>Daftar Tantangan</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Email</th>
                <th>Nama</th>
                <th>Tulisan</th>
                <th>Aksi</th>
            </tr>
            <?php
           
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'writing_challenge';

            $conn = new mysqli($host, $user, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kirim'])) {
                $tanggal = $_POST['tanggal'];
                $email = $_POST['email'];
                $nama = $_POST['nama'];
                $tulisan = $_POST['tulisan'];

                $sql = "INSERT INTO tantangan (tanggal, email, nama, tulisan) VALUES ('$tanggal', '$email', '$nama', '$tulisan')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Tantangan berhasil ditambahkan!');</script>";
                    
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            $sql = "SELECT * FROM tantangan";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["id"]."</td>
                            <td>".$row["tanggal"]."</td>
                            <td>".$row["email"]."</td>
                            <td>".$row["nama"]."</td>
                            <td>".$row["tulisan"]."</td>
                            <td>
                                <a href='edit.php?id=".$row["id"]."'>Edit</a>
                                <a href='delete.php?id=".$row["id"]."' onclick='return confirm(\"Yakin ingin menghapus?\");'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada tantangan.</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>

    
</body>
</html>
