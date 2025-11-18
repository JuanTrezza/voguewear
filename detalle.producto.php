<?php
require_once 'conexion.php';

$id = $_GET['id'] ?? null;
$producto = null;

if ($id) {
  $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
  $stmt->execute([$id]);
  $producto = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $producto ? $producto['nombre'] : 'Producto no encontrado' ?></title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
      <a href="index.php#contacto" class="nav-link text-white">Contacto</a>
    </nav>
  </div>
</header>

<!-- CONTENIDO -->
<div class="container py-5">
  <?php if ($producto): ?>
    <div class="row">
      <div class="col-md-6">
        <?php
          $imgRaw = $producto['imagen_url'];
          $imgEsc = htmlspecialchars($imgRaw);
          $imgSrc = (preg_match('/^https?:\\/\\//i', $imgRaw)) ? $imgEsc : 'imagenes/' . $imgEsc;
        ?>
        <img src="<?= $imgSrc ?>" class="img-fluid rounded shadow-sm" alt="<?= htmlspecialchars($producto['nombre']) ?>">
      </div>
      <div class="col-md-6">
        <h1><?= htmlspecialchars($producto['nombre']) ?></h1>
        <p class="text-muted"><?= htmlspecialchars($producto['descripcion']) ?></p>
        <h3>$<?= number_format($producto['precio'], 2) ?></h3>
        <a href="productos.php" class="btn btn-outline-secondary mt-3">← Volver a productos</a>
      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-danger">Producto no encontrado.</div>
    <a href="productos.php" class="btn btn-secondary">Volver</a>
  <?php endif; ?>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


