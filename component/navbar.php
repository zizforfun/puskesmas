<nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top bg-white">
  <div class="container">
    <a class="navbar-brand fw-bold text-success" href="index.php">Klinik Sehat Bersama</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto fw-semibold">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="ambilantrian.php">Ambil Antrian</a></li>
        <li class="nav-item"><a class="nav-link" href="antrian.php">Cek Antrian</a></li>
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
.nav-link {
  transition: all 0.3s ease;
}
.nav-link.active {
  color: #198754 !important;
  font-weight: bold;
  transform: scale(1.1);
}
</style>