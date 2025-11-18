<?php
session_start();
require_once 'conexion.php';

$contador = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Productos - VogueWear</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <style>
    .card img {
      height: 300px;
      object-fit: cover;
      transition: transform 0.3s ease;
    }
    .card:hover img {
      transform: scale(1.03);
    }
    .nav-link {
      margin-right: 15px;
    }
  </style>
</head>
<body>

<!-- HEADER -->
<header class="header py-3 bg-dark text-white">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="h4 m-0">VOGUEWEAR</h1>
    <nav class="nav">
      <a href="index.php" class="nav-link text-white">Inicio</a>
      <a href="productos.php" class="nav-link text-white">Productos</a>
      <a href="quines_somos.php" class="nav-link text-white">Quiénes Somos</a>
      <a href="contacto.php" class="nav-link text-white">Contacto</a>
      <a href="carrito.php" class="nav-link text-white">🛒 Carrito (<?= $contador ?>)</a>
    </nav>
  </div>
</header>

<!-- CONTENIDO -->
<div class="container py-5">
  <h2 class="text-center mb-4">Nuestros Productos</h2>
  <div class="row g-4">
    <?php
    $stmt = $pdo->query("SELECT * FROM productos");
    while ($p = $stmt->fetch()):
    ?>
      <div class="col-md-4" data-aos="fade-up">
        <div class="card h-100 shadow-sm">
          <a href="detalle_producto.php?id=<?= $p['id'] ?>">
            <?php
              $imgRaw = $p['imagen_url'];
              $imgEsc = htmlspecialchars($imgRaw);
              $imgSrc = (preg_match('/^https?:\\/\\//i', $imgRaw)) ? $imgEsc : 'imagenes/' . $imgEsc;
            ?>
            <img src="<?= $imgSrc ?>" class="card-img-top" alt="<?= htmlspecialchars($p['nombre']) ?>">
          </a>
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($p['nombre']) ?></h5>
            <p class="card-text">Precio: $<?= number_format($p['precio'], 2) ?></p>
            <p class="card-text">Talle: <?= htmlspecialchars($p['talle'] ?? 'Único') ?></p>

            <form method="post" action="carrito.php">
              <input type="hidden" name="id" value="<?= $p['id'] ?>">
              <input type="hidden" name="nombre" value="<?= $p['nombre'] ?>">
              <input type="hidden" name="precio" value="<?= $p['precio'] ?>">
              <input type="hidden" name="imagen" value="<?= $p['imagen_url'] ?>">
              <input type="hidden" name="talle" value="<?= $p['talle'] ?>">
              <button type="submit" name="agregar" class="btn btn-primary w-100">Agregar al carrito</button>
            </form>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<!-- FOOTER -->
<footer class="bg-dark text-white py-4 mt-5" id="contacto">
  <div class="container d-flex justify-content-between flex-wrap">
    <div class="mb-3">
      <h5>Sobre nosotros</h5>
      <p>Moda argentina de alta calidad.</p>
    </div>
    <div class="mb-3">
      <h5>Enlaces</h5>
      <a href="index.php" class="text-white d-block">Inicio</a>
      <a href="productos.php" class="text-white d-block">Productos</a>
      <a href="quines_somos.php" class="text-white d-block">Quiénes Somos</a>
      <a href="#contacto" class="text-white d-block">Contacto</a>
    </div>
    <div class="mb-3">
      <h5>Seguinos</h5>
      <a href="#" class="text-white d-block">Instagram</a>
      <a href="#" class="text-white d-block">Facebook</a>
    </div>
  </div>
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>


