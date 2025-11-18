<?php
require_once 'conexion.php';

if (!isset($_GET['id'])) {
    die("Producto no especificado");
}

$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch();

if (!$producto) {
    die("Producto no encontrado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($producto['nombre']) ?> - Detalle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="bg-dark text-white py-3">
  <div class="container d-flex justify-content-between">
    <h1 class="h4 m-0">VOGUEWEAR</h1>
    <nav>
      <a href="index.php" class="text-white me-3">Inicio</a>
      <a href="productos.php" class="text-white me-3">Productos</a>
      <a href="quines_somos.php" class="text-white me-3">Quiénes Somos</a>
      <a href="contacto.php" class="text-white">Contacto</a>
      
    </nav>
  </div>
</header>

<div class="container py-5">
  <div class="row">
    <div class="col-md-6">
      <?php
        $imgRaw = $producto['imagen_url'];
        $imgEsc = htmlspecialchars($imgRaw);
        $imgSrc = (preg_match('/^https?:\\/\\//i', $imgRaw)) ? $imgEsc : 'imagenes/' . $imgEsc;
      ?>
      <img src="<?= $imgSrc ?>" class="img-fluid" alt="<?= htmlspecialchars($producto['nombre']) ?>">
    </div>
    <div class="col-md-6">
      <h2><?= htmlspecialchars($producto['nombre']) ?></h2>
      <p class="lead">$<?= number_format($producto['precio'], 2) ?></p>
      <p><strong>Talle:</strong> <?= htmlspecialchars($producto['talle']) ?></p>
      <p><?= htmlspecialchars($producto['descripcion']) ?></p>

      <form method="post" action="carrito.php">
        <input type="hidden" name="id" value="<?= $producto['id'] ?>">
        <input type="hidden" name="nombre" value="<?= $producto['nombre'] ?>">
        <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
        <input type="hidden" name="imagen" value="<?= $producto['imagen_url'] ?>">
        <input type="hidden" name="talle" value="<?= $producto['talle'] ?>">
        <button type="submit" name="agregar" class="btn btn-primary">Agregar al carrito</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>
