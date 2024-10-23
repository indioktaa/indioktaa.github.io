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
$sql = "DELETE FROM tantangan WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Tantangan berhasil dihapus!'); window.location.href='index.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
