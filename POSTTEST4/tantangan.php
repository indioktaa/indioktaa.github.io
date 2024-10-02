<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit'])) {
        $tanggal = htmlspecialchars($_POST['tanggal']);
        $email = htmlspecialchars($_POST['email']);
        $nama = htmlspecialchars($_POST['nama']);
        $tulisan = htmlspecialchars($_POST['tulisan']);

        echo 'Data Tantangan: <br>';
        echo 'Tanggal: ' . $tanggal . '<br>';
        echo 'Email: ' . $email . '<br>';
        echo 'Nama Penulis: ' . $nama . '<br>';
        echo 'Isi Tantangan: <br>' . nl2br($tulisan) . '<br>'; 

        header('refresh:3; url=tantangan1.php');
        echo '<p>Kembali ke halaman utama dalam 3 detik. . .</p>';
    }
}
?>
