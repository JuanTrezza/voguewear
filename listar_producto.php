<?php
require_once 'conexion.php';
require_once 'Producto.php';

$productos = [];

try {
  $sql = "SELECT * FROM productos";
  $stmt = $pdo->query($sql);
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $producto = new Producto(
      $row['id'],
      $row['nombre'],
      $row['precio'],
      $row['talle'],
      $row['categoria'],
      $row['imagen_url'],
      $row['stock'],
      $row['descripcion']
    );
    $productos[] = $producto;
  }
} catch (PDOException $e) {
  die("Error al obtener productos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Productos</title>
  <style>
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
    th { background-color: #f2f2f2; }
    a.eliminar {
      color: red;
      text-decoration: none;
      font-weight: bold;
    }
    a.eliminar:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Listado de Productos</h1>

  <?php if (isset($_GET['msg']) && $_GET['msg'] === 'eliminado'): ?>
    <p style="color:green;">✅ Producto eliminado exitosamente.</p>
  <?php endif; ?>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Talle</th>
        <th>Categoría</th>
        <th>Stock</th>
        <th>Imagen</th>
        <th>Descripción</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($productos as $p): ?>
        <tr>
          <td><?= $p->id ?></td>
          <td><?= $p->nombre ?></td>
          <td>$<?= number_format($p->precio, 2) ?></td>
          <td><?= $p->talle ?></td>
          <td><?= $p->categoria ?></td>
          <td><?= $p->stock ?></td>
          <td><img src="<?= $p->imagen_url ?>" alt="img" width="50"></td>
          <td><?= $p->descripcion ?></td>
          <td>
            <a class="eliminar" href="eliminar_producto.php?id=<?= $p->id ?>" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>

