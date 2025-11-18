<?php
require_once 'conexion.php';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $email, $contraseña]);
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        $mensaje = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="text-center mb-4">Crear Cuenta</h2>
      <?php if ($mensaje): ?>
        <div class="alert alert-danger"><?= $mensaje ?></div>
      <?php endif; ?>
      <form method="post" class="bg-white p-4 shadow-sm rounded">
        <div class="mb-3">
          <label class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Correo electrónico</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Contraseña</label>
          <input type="password" name="contraseña" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-dark w-100">Registrarme</button>
        <p class="mt-3 text-center">¿Ya tenés cuenta? <a href="login.php">Iniciar sesión</a></p>
      </form>
    </div>
  </div>
</div>
</body>
</html>
