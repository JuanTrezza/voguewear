<?php
require_once 'conexion.php';
require_once 'Producto.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'];
  $precio = $_POST['precio'];
  $talle = $_POST['talle'];
  $categoria = $_POST['categoria'];
  $imagen_url = $_POST['imagen_url'];
  $stock = $_POST['stock'];
  $descripcion = $_POST['descripcion'];

  try {
    $sql = "INSERT INTO productos (nombre, precio, talle, categoria, imagen_url, stock, descripcion)
            VALUES (:nombre, :precio, :talle, :categoria, :imagen_url, :stock, :descripcion)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':nombre' => $nombre,
      ':precio' => $precio,
      ':talle' => $talle,
      ':categoria' => $categoria,
      ':imagen_url' => $imagen_url,
      ':stock' => $stock,
      ':descripcion' => $descripcion
    ]);
    $mensaje = "✅ Producto creado exitosamente.";
  } catch (PDOException $e) {
    $mensaje = "❌ Error: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Producto</title>
</head>
<body>
  <h1>Crear Producto</h1>

  <?php if ($mensaje): ?>
    <p><?= $mensaje ?></p>
  <?php endif; ?>

  <form method="post">
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="number" name="precio" placeholder="Precio" step="0.01" required><br>
    <input type="text" name="talle" placeholder="Talle"><br>
    <input type="text" name="categoria" placeholder="Categoría"><br>
    <input type="text" name="imagen_url" placeholder="URL de imagen"><br>
    <input type="number" name="stock" placeholder="Stock"><br>
    <textarea name="descripcion" placeholder="Descripción"></textarea><br>
    <button type="submit">Guardar</button>
  </form>
</body>
</html>


