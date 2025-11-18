<?php
session_start();
$contador = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Quiénes somos - VogueWear</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <style>
    .header {
      background-color: #000;
      color: #fff;
    }
    .banner-img {
      width: 100%;
      height: 400px;
      object-fit: cover;
      margin-bottom: 2rem;
    }
    .nav-link {
      margin-right: 15px;
    }
  </style>
</head>
<body>

<!-- HEADER -->
<header class="header py-3">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="h4 m-0">VOGUEWEAR</h1>
    <nav class="nav">
      <a href="index.php" class="nav-link text-white">Inicio</a>
      <a href="productos.php" class="nav-link text-white">Productos</a>
      <a href="quines_somos.php" class="nav-link text-white">Quiénes Somos</a>
      <a href="contacto.php" class="nav-link text-white">Contacto</a>
      <a href="carrito.php" class="nav-link text-white">🛒 Carrito (<?= $contador ?>)</a>
    </nav>
  </div>
</header>

<!-- BANNER -->
<section>
  <img src="imagenes/banner2.jpg" alt="Banner historia" class="banner-img" data-aos="fade-up">
</section>

<!-- HISTORIA -->
<section class="container py-5">
  <h2 class="text-center mb-4" data-aos="fade-up">Nuestra Historia</h2>
  <div class="row justify-content-center">
    <div class="col-md-10" data-aos="fade-up" data-aos-delay="200">
      <p class="lead text-center">
        VogueWear nació en 2020 como un emprendimiento familiar con la visión de fusionar el diseño argentino con las últimas tendencias internacionales. 
        Nuestro propósito es vestir a mujeres que buscan elegancia, comodidad y autenticidad en cada prenda.
      </p>
      <p class="text-center">
        Desde entonces, hemos crecido junto a nuestra comunidad, desarrollando colecciones responsables, hechas con materiales nobles y con amor por el detalle. 
        Nos inspira la mujer contemporánea, libre y segura.
      </p>
    </div>
  </div>
</section>

<!-- VALORES / ACORDEÓN -->
<section class="container py-4">
  <h3 class="mb-4 text-center" data-aos="fade-up">Nuestros Valores</h3>
  <div class="accordion" id="accordionValores" data-aos="fade-up">
    <div class="accordion-item">
      <h2 class="accordion-header" id="val1">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#col1">
          Diseño consciente
        </button>
      </h2>
      <div id="col1" class="accordion-collapse collapse show" data-bs-parent="#accordionValores">
        <div class="accordion-body">
          Creamos prendas con materiales sustentables y procesos éticos.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="val2">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#col2">
          Calidad
        </button>
      </h2>
      <div id="col2" class="accordion-collapse collapse" data-bs-parent="#accordionValores">
        <div class="accordion-body">
          Cada prenda es diseñada para durar, con una confección detallada y acabados de excelencia.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="val3">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#col3">
          Identidad local
        </button>
      </h2>
      <div id="col3" class="accordion-collapse collapse" data-bs-parent="#accordionValores">
        <div class="accordion-body">
          Celebramos el talento argentino y producimos localmente, con mano de obra nacional.
        </div>
      </div>
    </div>
  </div>
</section>

<!-- IMAGEN EXTRA -->
<section class="container py-5 text-center">
  <img src="imagenes/sobreNosotros2.png" alt="Lookbook VogueWear" class="img-fluid rounded shadow" data-aos="zoom-in">
</section>

<!-- FOOTER -->
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

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>
