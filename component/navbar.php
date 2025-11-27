<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>


<nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top bg-white">
  <div class="container">
    <a class="navbar-brand fw-bold text-success" href="index.php">
      <i class="bi bi-hospital text-success me-2"></i> Klinik Sehat Bersama
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto fw-semibold">
        <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house-door me-1"></i> Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="ambilantrian.php"><i class="bi bi-ticket-perforated me-1"></i> Ambil Antrian</a></li>
        <li class="nav-item"><a class="nav-link" href="antrian.php"><i class="bi bi-search me-1"></i> Cek Antrian</a></li>
      <?php if (isset($_SESSION['username'])): ?>
       
      <?php else: ?>
        
      <?php endif; ?> 


      </ul>
    </div>
  </div>
</nav>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
  const currentPath = window.location.pathname.split("/").pop();

  navLinks.forEach(link => {
    const href = link.getAttribute("href");

    // Jika di index.php atau href = "#", tandai Beranda
    if ((currentPath === "" && href === "index.php") || 
        (currentPath === "index.php" && href === "index.php") || 
        (href === "#" && currentPath === "")) {
      link.classList.add("active", "text-success");
    } else if (href === currentPath) {
      link.classList.add("active", "text-success");
    } else {
      link.classList.remove("active", "text-success");
    }
  });
});
</script>
<style>
.navbar { background: linear-gradient(90deg, #0f5132, #198754);
    border-bottom: 1px solid rgba(255, 255, 255, 0.15); box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);}
.navbar-brand { color: #ffffff !important; font-weight: 700;}
.navbar-brand i { color: #c6ffd9 !important;}
.nav-link { color: #e8fff1 !important; transition: all 0.3s ease;}
.nav-link.active,
.nav-link:hover { color: #ffffff !important; transform: scale(1.07);}
.nav-link i { color: #d4ffe4 !important;}
.nav-link:hover i,
.nav-link.active i { color: #ffffff !important;}
.navbar-toggler { border-color: rgba(255,255,255,0.5);}
.navbar-toggler-icon {filter: brightness(0) invert(1);}
</style>