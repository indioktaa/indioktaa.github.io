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

const formTantangan = document.getElementById('form-tantangan');
const hasilTulisan = document.getElementById('hasil-tulisan');
const isiTulisan = document.getElementById('isi-tulisan');

if (formTantangan) {
    formTantangan.addEventListener('submit', function(event) {
        event.preventDefault(); 
        const tanggal = document.getElementById('tanggal').value;
        const email = document.getElementById('email').value;
        const nama = document.getElementById('nama').value;
        const tulisan = document.getElementById('tulisan').value;

        hasilTulisan.style.display = 'block';
        isiTulisan.innerHTML = `
            <strong>Tanggal:</strong> ${tanggal} <br>
            <strong>Email:</strong> ${email} <br>
            <strong>Nama Penulis:</strong> ${nama} <br>
            <strong>Isi Tantangan:</strong> <br>
            ${tulisan.replace(/\n/g, '<br>')} 
        `;

        
        formTantangan.reset();
    });
}

function goBack() {
    history.back();
}

const backToHomeButton = document.querySelector('.link .btn');
if (backToHomeButton) {
    backToHomeButton.addEventListener('click', function() {
        window.location.href = 'index.php';
    });
}
const hamburger = document.querySelector(".hamburger");
let navbar = document.querySelector('.header .flex .navbar');

if (hamburger) {
    hamburger.addEventListener("click", () => {
        hamburger.classList.toggle("active");
        navbar.classList.toggle("active");
    });
}
