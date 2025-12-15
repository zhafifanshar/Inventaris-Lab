<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:/inventaris_lab/auth/login.php");
    exit;
}

/* helper menu aktif */
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Inventaris Lab</title>

<link rel="stylesheet" href="/inventaris_lab/assets/bootstrap/bootstrap.min.css">

<style>
body {
    margin:0;
    font-family: 'Segoe UI', sans-serif;
    background:#f4f6fb;
}

.wrapper {
    display:flex;
    min-height:100vh;
}

/* SIDEBAR */
.sidebar {
    width:260px;
    background: linear-gradient(180deg, #4e54c8, #8f94fb);
    color:white;
    padding:25px;
}

.sidebar h4 {
    text-align:center;
    margin-bottom:25px;
    font-weight:700;
}

/* PROFIL */
.profile-box {
    background:rgba(255,255,255,0.15);
    border-radius:15px;
    padding:15px;
    margin-bottom:25px;
    text-align:center;
}

.profile-box .avatar {
    width:60px;
    height:60px;
    border-radius:50%;
    background:rgba(255,255,255,0.3);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:26px;
    font-weight:700;
    margin:0 auto 10px;
}

.profile-box .name {
    font-weight:600;
}

.profile-box .prodi {
    font-size:13px;
    opacity:0.9;
}

/* MENU */
.sidebar a {
    display:flex;
    align-items:center;
    gap:10px;
    color:white;
    text-decoration:none;
    padding:12px 15px;
    border-radius:10px;
    margin-bottom:10px;
    transition:0.3s;
}

.sidebar a:hover {
    background:rgba(255,255,255,0.2);
    transform:translateX(5px);
}

.sidebar a.active {
    background:rgba(255,255,255,0.3);
    font-weight:600;
}

/* CONTENT */
.content {
    flex:1;
    padding:40px;
}

/* CARD */
.card {
    border:none;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}
</style>
</head>
<body>

<div class="wrapper">

<div class="sidebar">
    <h4>📦 Inventaris Lab</h4>

    <!-- PROFIL USER -->
    <div class="profile-box">
        <div class="avatar">
            <?= strtoupper(substr($_SESSION['nama'] ?? $_SESSION['username'], 0, 1)); ?>
        </div>
        <div class="name">
            <?= $_SESSION['nama'] ?? $_SESSION['username']; ?>
        </div>
        <div class="prodi">
            <?= $_SESSION['prodi'] ?? 'Prodi belum diisi'; ?>
        </div>
        <a href="/inventaris_lab/auth/profil.php"
           style="margin-top:10px; background:rgba(255,255,255,0.2); justify-content:center;">
           Profil Saya
        </a>
    </div>

    <!-- MENU -->
    <a href="/inventaris_lab/index.php"
       class="<?= $current=='index.php'?'active':'' ?>">
       🏠 Dashboard
    </a>

    <a href="/inventaris_lab/alat/index.php"
       class="<?= $current=='index.php' && strpos($_SERVER['PHP_SELF'],'/alat/')!==false?'active':'' ?>">
       🔧 Data Alat
    </a>

    <a href="/inventaris_lab/peminjaman/index.php"
       class="<?= $current=='index.php' && strpos($_SERVER['PHP_SELF'],'/peminjaman/')!==false?'active':'' ?>">
       📋 Peminjaman
    </a>

    <hr>
    <a href="/inventaris_lab/auth/logout.php">🚪 Logout</a>
</div>

<div class="content">
