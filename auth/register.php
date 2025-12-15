<?php
session_start();
include "../config/koneksi.php";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama     = $_POST['nama'];
    $prodi    = $_POST['prodi'];

    mysqli_query($conn,"
        INSERT INTO users (username,password,nama,prodi,role)
        VALUES ('$username','$password','$nama','$prodi','user')
    ");

    echo "<script>alert('Registrasi berhasil');location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Register | Inventaris Lab</title>
<link rel="stylesheet" href="/inventaris_lab/assets/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    height:100vh;
    background:linear-gradient(135deg,#667eea,#764ba2);
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:'Segoe UI',sans-serif;
}

.card-auth{
    width:420px;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(15px);
    border-radius:24px;
    padding:30px;
    box-shadow:0 25px 50px rgba(0,0,0,.25);
    animation:fadeUp .6s ease;
    color:white;
}

@keyframes fadeUp{
    from{opacity:0;transform:translateY(40px)}
    to{opacity:1;transform:translateY(0)}
}

.form-control{
    background:rgba(255,255,255,.85);
    border:none;
    border-radius:12px;
}

.btn{
    border-radius:12px;
}
</style>
</head>
<body>

<div class="card-auth text-center">
    <h4 class="fw-bold mb-3">📝 Daftar Akun</h4>

    <form method="post">
        <div class="mb-2">
            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
        </div>
        <div class="mb-2">
            <input type="text" name="prodi" class="form-control" placeholder="Program Studi">
        </div>
        <div class="mb-2">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button name="register" class="btn btn-light w-100 fw-semibold">
            Daftar
        </button>
    </form>

    <div class="mt-3 small">
        Sudah punya akun?
        <a href="login.php" class="text-white fw-semibold text-decoration-underline">
            Login
        </a>
    </div>
</div>

</body>
</html>
