<?php
require_once 'conexion.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  try {
    $sql = "DELETE FROM productos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    header("Location: listar_productos.php?msg=eliminado");
    exit;
  } catch (PDOException $e) {
    die("Error al eliminar producto: " . $e->getMessage());
  }
} else {
  header("Location: listar_productos.php");
}
