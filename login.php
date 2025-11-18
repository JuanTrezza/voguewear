<?php
session_start();
require_once 'conexion.php';

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        header("Location: index.php");
        exit();
    } else {
        $mensaje = 'Credenciales incorrectas.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="text-center mb-4">Iniciar Sesión</h2>
      <?php if ($mensaje): ?>
        <div class="alert alert-danger"><?= $mensaje ?></div>
      <?php endif; ?>
      <form method="post" class="bg-white p-4 shadow-sm rounded">
        <div class="mb-3">
          <label class="form-label">Correo electrónico</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Contraseña</label>
          <input type="password" name="contraseña" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-dark w-100">Ingresar</button>
        <p class="mt-3 text-center">¿No tenés cuenta? <a href="registro.php">Registrate</a></p>
      </form>
    </div>
  </div>
</div>
</body>
</html>
