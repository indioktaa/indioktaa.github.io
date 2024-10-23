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

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION["login"] = true;

            if ($user["role"] === "Admin") {
                $_SESSION["role"] = "Admin";
                echo "
                <script>
                    alert('Selamat Datang, Admin $username <3');
                    document.location.href = 'CRUDadmin.php';
                </script>
                ";
            } else {
                $_SESSION["role"] = "User";
                echo "
                <script>
                    alert('Selamat Datang, $username <3');
                    document.location.href = 'index.html';
                </script>
                ";
            }
        } else {
            echo "
            <script>
                alert('Password salah cuy!!!');
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('Username nggak ada boy!!!');
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <h1>Halaman Login</h1>
    <form action="" method="post">
        <table>
            <tr>
                <td>
                    <label for="username">Username</label>
                </td>
                <td>
                    <input type="text" name="username" id="username" placeholder="Masukan Username..." required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Password</label>
                </td>
                <td>
                    <input type="password" name="password" id="password" placeholder="Masukkan Password..." required>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="submit">Submit</button>
                </td>
            </tr>
        </table>
    </form>

    <p>
        Belum Ada Akun? 
        <a href="registrasi.php">Klik Disini</a>
    </p>
</body>
</html>