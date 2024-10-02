
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MULAI TANTANGAN HARI INI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="styletantangan.css">
    
</head>
<body>
    <div class="container">
        <h1 class="logo"> <i class="fa-sharp fa-solid fa-pencil"></i> Ayo Selesaikan Tantangan </h1>
        <h2 class="form-title">Mulai Tantangan Hari Ini</h2>
        
        <p id="tema-tantangan">Tema Tantangan: <span id="tema">Tema akan ditampilkan di sini</span></p>

        <form id="form-tantangan" method="POST" action="tantangan.php">
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
                <input type="text" id="nama" name="nama" placeholder="Masukan nama penulis" required>
            </div>

            <div class="input">
                <label for="tulisan">Isi Tantangan:</label>
                <textarea id="tulisan" name="tulisan" placeholder="Tulis di sini. . ." rows="6" required></textarea>
            </div>

            <input type="submit" class="button" value="Kirim Tantangan" name="kirim">  
        </form>

        <div id="hasil-tulisan" style="display:none">
            <h3>Tulisan Anda</h3>
            <p id="isi-tulisan"></p>
        </div>

        <div class="link">
            <p>Ingin kembali ke halaman utama?</p>
            <a href="index.html" class="btn">Kembali ke Home</a>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>





