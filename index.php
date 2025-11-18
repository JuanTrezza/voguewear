<?php
session_start();
require_once 'conexion.php';
require_once 'Producto.php';


$productos = [];
try {
    $sql = "SELECT * FROM productos";
   $stmt = $pdo->query("SELECT * FROM productos ORDER BY id DESC LIMIT 4");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $productos[] = new Producto(
            $row['id'],
            $row['nombre'],
            $row['precio'],
            $row['talle'],
            $row['categoria'],
            $row['imagen_url'],
            $row['stock'],
            $row['descripcion']
        );
    }
} catch (PDOException $e) {
    die("Error al obtener productos: " . $e->getMessage());
}

$contador = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tienda VogueWear</title>
    <link rel="stylesheet" href="estilos.css" />
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<body>

   <header class="header py-3 bg-dark text-white">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="h4 m-0">VOGUEWEAR</h1>
    <nav class="nav align-items-center">
      <a href="index.php" class="nav-link text-white">Inicio</a>
      <a href="productos.php" class="nav-link text-white">Productos</a>
      <a href="quines_somos.php" class="nav-link text-white">Quiénes Somos</a>
      <a href="contacto.php" class="nav-link text-white">Contacto</a>
      <a href="carrito.php" class="nav-link text-white">🛒 Carrito</a>

      <?php if (isset($_SESSION['usuario_nombre'])): ?>
        <span class="ms-3 text-white">👤 <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></span>
        <a href="logout.php" class="btn btn-sm btn-outline-light ms-2">Cerrar sesión</a>
      <?php else: ?>
        <a href="login.php" class="btn btn-sm btn-outline-light ms-3">Iniciar sesión</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

    
    <section class="hero-banner">
      <img src="imagenes/banner-hero1.jpg" alt="Colección actual">
      <div class="banner-text">
        <h1>Nueva Colección 2025</h1>
        <p>Descubrí la moda que marca tendencia</p>
        <a href="productos.php" class="btn‑banner">VER PRODUCTOS</a>
      </div>
    </section>

    <!-- Sección de productos destacados -->
    <section id="productos" class="productos">
      <h2>Productos destacados</h2>
      <div class="grid">
        <?php foreach ($productos as $p): ?>
          <div class="producto">
            <?php
              $imgRaw = $p->imagen_url;
              $imgEsc = htmlspecialchars($imgRaw);
              $imgSrc = (preg_match('/^https?:\\/\\//i', $imgRaw)) ? $imgEsc : 'imagenes/' . $imgEsc;
            ?>
            <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($p->nombre) ?>">
            <h3><?= htmlspecialchars($p->nombre) ?></h3>
            <p class="precio">$<?= number_format($p->precio, 2) ?></p>
            <small class="talle">Talle: <?= htmlspecialchars($p->talle) ?></small>

            <form method="post" action="carrito.php">
              <input type="hidden" name="id" value="<?= $p->id ?>">
              <input type="hidden" name="nombre" value="<?= $p->nombre ?>">
              <input type="hidden" name="precio" value="<?= $p->precio ?>">
              <input type="hidden" name="imagen" value="<?= $p->imagen_url ?>">
              <input type="hidden" name="talle" value="<?= $p->talle ?>">
              <button type="submit" name="agregar" class="boton‑agregar">Agregar al carrito</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

  <footer class="bg-dark text-white py-4" id="contacto">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>




