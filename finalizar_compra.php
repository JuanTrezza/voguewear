<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$carrito = $_SESSION['carrito'] ?? [];

if (empty($carrito)) {
    echo "<script>alert('Tu carrito está vacío'); window.location='productos.php';</script>";
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$total = array_sum(array_column($carrito, 'precio'));

try {
    $pdo->beginTransaction();

    // Insertar el pedido
    $stmt = $pdo->prepare("INSERT INTO pedidos (usuario_id, total) VALUES (?, ?)");
    $stmt->execute([$usuario_id, $total]);
    $pedido_id = $pdo->lastInsertId();

    // Insertar los items
    $stmtItem = $pdo->prepare("INSERT INTO pedido_items (pedido_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");

    foreach ($carrito as $item) {
        $stmtItem->execute([
            $pedido_id,
            $item['id'],
            1, // cantidad fija, podrías modificarlo si usás cantidades
            $item['precio']
        ]);
    }

    $pdo->commit();
    unset($_SESSION['carrito']);
    $mensaje = "¡Gracias por tu compra! Tu pedido fue procesado con éxito.";

} catch (Exception $e) {
    $pdo->rollBack();
    die("Error al procesar el pedido: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pedido confirmado - VogueWear</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body>

<header class="bg-dark text-white py-3">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="h4 m-0">VOGUEWEAR</h1>
    <nav>
      <a href="index.php" class="text-white me-3">Inicio</a>
      <a href="productos.php" class="text-white me-3">Productos</a>
      <a href="contacto.php" class="text-white me-3">Contacto</a>
    </nav>
  </div>
</header>

<main class="container py-5" data-aos="fade-up">
  <div class="text-center">
    <h2 class="mb-4 text-success"><?= $mensaje ?></h2>
    <p>Podés seguir navegando nuestros productos o volver al inicio.</p>
    <a href="productos.php" class="btn btn-outline-primary mt-3">Seguir comprando</a>
  </div>
</main>

<footer class="bg-dark text-white text-center py-4 mt-5">
  <p>&copy; 2025 VogueWear. Todos los derechos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>
