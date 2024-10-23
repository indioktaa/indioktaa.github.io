<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayo Tingkatkan Kemampuan Menulis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="styletantangan.css">
    <style>
        .container {
            max-width: 1500px; 
            margin: 30px auto; 
            padding: 40px; 
            background-color: var(--white); 
            border-radius: var(--border-radius); 
            box-shadow: var(--box-shadow); 
            text-align: center; 
            overflow-x: auto;
        }

        .kembali-btn {
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

        .kembali-btn:hover {
            background-color: #ffa500;
        }

        .kembali-btn:active {
            background-color: #3e8e41;
            transform: scale(0.98);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="logo"><i class="fa-sharp fa-solid fa-pencil"></i> Ayo Selesaikan Tantangan</h1>
        
        <p id="tema-tantangan">Tema Tantangan: <span id="tema">Tema akan ditampilkan di sini</span></p>
        
        <h2 class="form-title">Mulai Tantangan Hari Ini</h2>
        
        <form id="form-tantangan" method="POST" action="index.php" enctype="multipart/form-data">
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

            <div class="input">
                <input type="file" name="gambar" id="gambar" required>
                <label for="gambar">Upload Foto Penulis</label>
                <br>
            </div>

            <input type="submit" class="button" value="Kirim Tantangan" name="kirim">  
        </form>

        <a href="index.html" class="kembali-btn">Kembali ke Halaman Utama</a>

        <h2>Daftar Tantangan</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Email</th>
                <th>Nama</th>
                <th>Tulisan</th>
                <th>Gambar</th>
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

            $maxfilesize = 500 * 1024;

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kirim'])) {
                $tanggal = $_POST['tanggal'];
                $email = $_POST['email'];
                $nama = $_POST['nama'];
                $tulisan = $_POST['tulisan'];
                $tmp_name = $_FILES["gambar"]["tmp_name"];
                $file_name = $_FILES["gambar"]["name"];
                
                if ($_FILES["gambar"]["size"] > $maxfilesize){
                    echo "
                    <script> alert('Ukuran file terlalu besar. Batas maksimal 500 KB.');
                    </script>";
                }else{
                    $ekstensi = pathinfo($file_name, PATHINFO_EXTENSION);
                    $newFileName = date('Y-m-d H.i.s') . '.' . strtolower($ekstensi);

                    if(move_uploaded_file($tmp_name, 'img/' . $newFileName)){
                        $sql = "INSERT INTO tantangan (tanggal, email, nama, tulisan, gambar) VALUES ('$tanggal', '$email', '$nama', '$tulisan', '$newFileName')";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            echo "
                            <script> 
                            alert('Data Berhasil Ditambahkan');
                            document.location.href = 'index.php';
                            </script>
                            ";
                        } else {
                            echo "
                            <script>
                            alert('Gagal menambahkan data');
                            document.location.href = 'index.php';
                            </script>
                            ";
                        }
                    }
                }
            }

            $sql = "SELECT * FROM tantangan";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $direktori = "img/" . $row["gambar"];
                    echo "<tr>
                            <td>".$row["id"]."</td>
                            <td>".$row["tanggal"]."</td>
                            <td>".$row["email"]."</td>
                            <td>".$row["nama"]."</td>
                            <td>".$row["tulisan"]."</td>
                            <td>
                                <center>";
                    if ($row["gambar"] == "") {
                        echo "Foto belum ada";
                    } else {
                        echo "<img src='$direktori' alt='gambar' width='50px' height='50px'>";
                    }
                    echo "</center></td>
                            <td>
                                <a href='edit.php?id=".$row["id"]."'>Edit</a>
                                <a href='delete.php?id=".$row["id"]."' onclick='return confirm(\"Yakin ingin menghapus?\");'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada tantangan.</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const temaArray = [
                "Sehari di Kota yang Tidak Pernah Tidur",
                "Menulis Surat untuk Diri di Masa Depan",
                "Perjalanan ke Tempat yang Selalu Kamu Impikan",
                "Dialog Antara Dua Orang yang Tidak Pernah Bertemu",
                "Kisah di Taman yang Menyimpan Rahasia",
                "Petualangan di Sebuah Perpustakaan Terbengkalai",
                "Sebuah Tempat di Mana Waktu Berhenti Hanya untuk Satu Menit",
                "Jika Kamu Bisa Menghapus Sebuah Kenangan, Mana yang Akan Kamu Pilih?",
                "Cerita dari Sudut Pandang Ponsel yang Hilang",
                "Rahasia yang Tersembunyi di Dalam Surat yang Tak Pernah Terkirim",
                "Pengalaman Berkesan di Kota yang Tak Pernah Dikunjungi",
                "Kehidupan di Tengah Kota Kecil yang Terlupakan",
                "Jika Hidupmu Adalah Buku, Bab Apa yang Paling Menarik?",
                "Kisah Tentang Persahabatan yang Tak Lekang oleh Waktu",
                "Hari di Mana Semua Orang di Dunia Berbicara Bahasa yang Sama",
                "Pertemuan Tak Terduga di Tempat yang Paling Aneh",
                "Sebuah Kafe di Mana Semua Orang Menceritakan Mimpinya",
                "Jika Kamu Bisa Melihat Masa Lalu dari Sebuah Foto, Apa yang Akan Terjadi?",
                "Surat yang Tak Sengaja Terkirim ke Alamat yang Salah",
                "Petualangan Tak Terduga di Dalam Stasiun Kereta yang Terlupakan"
            ];

            const temaTantangan = temaArray[Math.floor(Math.random() * temaArray.length)];
            document.getElementById('tema').innerText = temaTantangan;

            const backToHomeButton = document.querySelector('.kembali-btn');
            if (backToHomeButton) {
                backToHomeButton.addEventListener('click', function() {
                    window.location.href = 'index.php';
                });
         
         }  });
    </script>

</body>
</html>

