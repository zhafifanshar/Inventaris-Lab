<?php
session_start();
include "../config/koneksi.php";

if (isset($_SESSION['login'])) {
    header("location:/inventaris_lab/index.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($q) > 0) {
        $u = mysqli_fetch_assoc($q);
        if (password_verify($password, $u['password'])) {
            $_SESSION['login']    = true;
            $_SESSION['id_user']  = $u['id'];
            $_SESSION['username'] = $u['username'];
            $_SESSION['nama']     = $u['nama'];
            $_SESSION['prodi']    = $u['prodi'];
            $_SESSION['role']     = $u['role'];
            header("location:/inventaris_lab/index.php");
            exit;
        }
    }
    $error = "Username atau password salah";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login | Inventaris Lab</title>
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
    overflow:hidden;
}

/* glow background */
body::before{
    content:'';
    position:absolute;
    width:500px;
    height:500px;
    background:rgba(255,255,255,0.15);
    border-radius:50%;
    filter:blur(120px);
    top:-100px;
    left:-100px;
}

.card-auth{
    width:380px;
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

.logo{
    width:70px;
    height:70px;
    background:rgba(255,255,255,.2);
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:32px;
    margin:auto;
}

.form-control{
    background:rgba(255,255,255,.85);
    border:none;
    border-radius:12px;
}

.form-control:focus{
    box-shadow:0 0 0 .2rem rgba(255,255,255,.4);
}

.btn{
    border-radius:12px;
    transition:.3s;
}
.btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(0,0,0,.25);
}
</style>
</head>
<body>

<div class="card-auth text-center">
    <div class="logo mb-3">🔬</div>
    <h4 class="fw-bold">Inventaris Lab</h4>
    <p class="small mb-4">Silakan login untuk melanjutkan</p>

    <?php if(isset($error)){ ?>
        <div class="alert alert-danger py-2"><?= $error ?></div>
    <?php } ?>

    <form method="post">
        <div class="mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button name="login" class="btn btn-light w-100 fw-semibold">
            Login
        </button>
    </form>

    <div class="mt-3 small">
        Belum punya akun?
        <a href="register.php" class="text-white fw-semibold text-decoration-underline">
            Daftar
        </a>
    </div>
</div>

</body>
</html>
