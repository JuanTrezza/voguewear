<?php
session_start();

// Agregar producto
if (isset($_POST['agregar'])) {
  $producto = [
    'id' => $_POST['id'],
    'nombre' => $_POST['nombre'],
    'precio' => $_POST['precio'],
    'imagen' => $_POST['imagen'],
    'talle' => $_POST['talle']
  ];

  $_SESSION['carrito'][] = $producto;
  header("Location: carrito.php");
  exit();
}

// Eliminar producto
if (isset($_GET['eliminar'])) {
  $indice = $_GET['eliminar'];
  unset($_SESSION['carrito'][$indice]);
  $_SESSION['carrito'] = array_values($_SESSION['carrito']);
  header("Location: carrito.php");
  exit();
}

// Vaciar carrito
if (isset($_GET['vaciar'])) {
  unset($_SESSION['carrito']);
  header("Location: carrito.php");
  exit();
}

$contador = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito - VogueWear</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>

  <header class="header">
    <div class="container">
      <div class="logo">VOGUEWEAR</div>
      <nav class="nav">
        <a href="index.php">Inicio</a>
        <a href="productos.php">Productos</a>
        <a href="quines_somos.php">Quiénes Somos</a>
        <a href="contacto.php">Contacto</a>
        <a href="carrito.php">🛒 Carrito (<?= $contador ?>)</a>
      </nav>
    </div>
  </header>

  <section class="productos">
    <h2>Tu carrito de compras</h2>

    <?php if (!empty($_SESSION['carrito'])): ?>
      <table style="width: 90%; margin: auto; border-collapse: collapse;">
        <thead>
          <tr style="background-color: #eee;">
            <th>Imagen</th>
            <th>Producto</th>
            <th>Talle</th>
            <th>Precio</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($_SESSION['carrito'] as $i => $item): ?>
            <tr style="text-align: center; border-bottom: 1px solid #ccc;">
              <td><img src="imagenes/<?= htmlspecialchars($item['imagen']) ?>" style="height: 80px;"></td>
              <td><?= htmlspecialchars($item['nombre']) ?></td>
              <td><?= htmlspecialchars($item['talle']) ?></td>
              <td>$<?= number_format($item['precio'], 2) ?></td>
              <td><a href="carrito.php?eliminar=<?= $i ?>" style="color: red;">Eliminar</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div style="text-align: center; margin-top: 20px;">
        <a href="carrito.php?vaciar=true" style="color: #e91e63;">Vaciar carrito</a>
      </div>
      <div class="text-center mt-3">
  <a href="finalizar_compra.php" class="btn btn-success">Finalizar compra</a>
</div>


    <?php else: ?>
      <p style="text-align: center;">Tu carrito está vacío.</p>
    <?php endif; ?>
  </section>

</body>
</html>


