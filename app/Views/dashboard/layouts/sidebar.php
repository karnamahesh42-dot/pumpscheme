<?php
$session = session();
// session check
if (!$session->has('isLoggedIn') || !$session->has('user_id') || !$session->has('username') || !$session->has('role_id')) {
    header("Location: " . base_url('/login'));
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>గూటాల ఎత్తి పోతలు పథకం</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url('public/dist/css/costomstyle.css') ?>">
  
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

<style>
body,.card-title {
    font-family: 'Lato', sans-serif;
}
h1, h2, h3, h4, .card-title {
    font-family: 'Playfair Display', serif; !important;
}
</style>

  <style>
  .card-header{
      background: #398aaaff;
  }

.sidebar::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('<?= base_url("public/dist/loginBG.png") ?>');
    background-size: cover;
    background-position: center;
    opacity: 0.4;
    z-index: -1;
}


    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: var(--sidebar-width);
      height: 100%;
      /* background: linear-gradient(180deg, #4aa8ff,#ff7272); */
      background: rgba(18, 19, 18, 0.65);
      color: #fff;
      transition: all 0.3s ease;
      overflow-y: auto;
      padding: 0px 10px;
      z-index: 1040;
    }
</style>

</head>
<body>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
  
  <div class="brand-area">
      <img src="<?= base_url('public/dist/gootalaProjectLogo.png') ?>" alt="Logo">
  </div>

  <ul class="nav flex-column">

      <li>
        <a class="nav-link <?= (uri_string()=='' || uri_string()=='dashboard') ? 'active' : '' ?>" 
          href="<?= base_url('/') ?>">
          <i class="bi bi-house-fill"></i> Home
        </a>
      </li>


      <li>
        <a class="nav-link" href="<?= base_url('logout') ?>">
          <i class="bi bi-box-arrow-right"></i> Logout
        </a>
      </li>

  </ul>

</nav>


<!-- Overlay -->
<div class="overlay" id="overlay"></div>
