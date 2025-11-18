<?php
class Producto {
    public $id, $nombre, $precio, $talle, $categoria, $imagen_url, $stock, $descripcion;

    public function __construct($id, $nombre, $precio, $talle, $categoria, $imagen_url, $stock, $descripcion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->talle = $talle;
        $this->categoria = $categoria;
        $this->imagen_url = $imagen_url;
        $this->stock = $stock;
        $this->descripcion = $descripcion;
    }

    // Obtener todos los productos
    public static function obtenerTodos($pdo) {
        $stmt = $pdo->query("SELECT * FROM productos");
        $productos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = new self(
                $row['id'],
                $row['nombre'],
                $row['precio'],
                $row['talle'],
                $row['categoria'],
                $row['imagen_url'],
                $row['stock'],
                $row['descripcion']
            );
        }
        return $productos;
    }

    // Buscar producto por ID
    public static function buscarPorId($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new self(
                $row['id'],
                $row['nombre'],
                $row['precio'],
                $row['talle'],
                $row['categoria'],
                $row['imagen_url'],
                $row['stock'],
                $row['descripcion']
            );
        }
        return null;
    }

    // Crear nuevo producto
    public function crear($pdo) {
        $stmt = $pdo->prepare("INSERT INTO productos (nombre, precio, talle, categoria, imagen_url, stock, descripcion) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $this->nombre,
            $this->precio,
            $this->talle,
            $this->categoria,
            $this->imagen_url,
            $this->stock,
            $this->descripcion
        ]);
    }

    // Actualizar producto
    public function actualizar($pdo) {
        $stmt = $pdo->prepare("UPDATE productos SET nombre = ?, precio = ?, talle = ?, categoria = ?, imagen_url = ?, stock = ?, descripcion = ? WHERE id = ?");
        return $stmt->execute([
            $this->nombre,
            $this->precio,
            $this->talle,
            $this->categoria,
            $this->imagen_url,
            $this->stock,
            $this->descripcion,
            $this->id
        ]);
    }

    // Eliminar producto
    public static function eliminar($pdo, $id) {
        $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

