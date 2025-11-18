<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito']) || !isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$carrito = $_SESSION['carrito'];

$total = 0;
foreach ($carrito as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

$sql = "INSERT INTO pedidos (usuario_id, total) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$usuario_id, $total]);
$pedido_id = $pdo->lastInsertId();

foreach ($carrito as $item) {
    $sql_item = "INSERT INTO pedido_items (pedido_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
    $stmt_item = $pdo->prepare($sql_item);
    $stmt_item->execute([$pedido_id, $item['id'], $item['cantidad'], $item['precio']]);
}

unset($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pedido Confirmado - VogueWear</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <style>
    body { font-family: Arial, sans-serif; }
    .confirmacion {
      padding: 80px 20px;
      text-align: center;
    }
  </style>
</head>
<body>

<header class="header py-3 bg-dark text-white">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="h4 m-0">VOGUEWEAR</h1>
    <nav class="nav">
      <a href="index.php" class="nav-link text-white">Inicio</a>
      <a href="productos.php" class="nav-link text-white">Productos</a>
      <a href="quines_somos.php" class="nav-link text-white">Quiénes Somos</a>
      <a href="contacto.php" class="nav-link text-white">Contacto</a>
      <a href="carrito.php" class="nav-link text-white">🛒 Carrito</a>
    </nav>
  </div>
</header>

<div class="confirmacion" data-aos="zoom-in">
  <h2 class="text-success">¡Gracias por tu compra!</h2>
  <p>Tu pedido fue registrado correctamente.</p>
  <a href="index.php" class="btn btn-outline-dark mt-4">Volver al inicio</a>
</div>

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
      <a href="contacto.php" class="text-white d-block">Contacto</a>
    </div>
    <div class="mb-3">
      <h5>Seguinos</h5>
      <a href="#" class="text-white d-block">Instagram</a>
      <a href="#" class="text-white d-block">Facebook</a>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>
