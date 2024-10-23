<?php
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
    $cpassword = $_POST["cpassword"];
    $role = $_POST["role"];

    if ($password === $cpassword) {
        $checkQuery = "SELECT * FROM user WHERE username = '$username'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            echo "
            <script>
                alert('Username sudah ada boy!!!');
                document.location.href = 'registrasi.php';
            </script>
            ";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO user (username, password, role) VALUES('$username', '$password', '$role')";

            if (mysqli_query($conn, $query)) {
                echo "
                <script>
                    alert('Ciee Berhasil Registrasi!');
                    document.location.href = 'login.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('NT Gagal Registrasi!');
                    document.location.href = 'registrasi.php';
                </script>
                ";
            }
        }
    } else {
        echo "
        <script>
            alert('Password dan Konfirmasi Password Harus Sesuai Boy!!!');
            document.location.href = 'registrasi.php';
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <h1>Halaman Registrasi</h1>
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
                <td>
                    <label for="cpassword">Konfirmasi Password</label>
                </td>
                <td>
                    <input type="password" name="cpassword" id="cpassword" placeholder="Masukkan Konfirmasi Password..." required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="role">Role</label>
                </td>
                <td>
                    <select name="role" id="role" required>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
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
</body>
</html>