<?php
require 'Connect.php';

// Verificar el método de solicitud
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener todos los libros
    $sql = "SELECT * FROM libros";
    $stmt = $conn->query($sql);
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($libros);

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear un nuevo libro
    $data = json_decode(file_get_contents("php://input"), true);

    $titulo = $data['titulo'];
    $autor = $data['autor'];
    $genero = $data['genero'];
    $anioPublicacion = $data['anio_publicacion'];
    $estado = $data['estado']; // Puedes establecer un estado predeterminado aquí

    $sql = "INSERT INTO libros (titulo, autor, genero, anio_publicacion, estado)
            VALUES ('$titulo', '$autor', '$genero', '$anioPublicacion', '$estado')";
    
    try {
        $conn->exec($sql);
        echo json_encode(['message' => 'Libro creado con éxito']);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al crear el libro: ' . $e->getMessage()]);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Actualizar un libro existente
    $data = json_decode(file_get_contents("php://input"), true);

    $bookId = $data['id'];
    $estado = $data['estado'];

    $sql = "UPDATE libros 
            SET estado=?
            WHERE id=?";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$estado, $bookId]);
        echo json_encode(['message' => 'Libro actualizado con éxito']);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al actualizar el libro: ' . $e->getMessage()]);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Eliminar un libro
    $data = json_decode(file_get_contents("php://input"), true);
    $bookId = $data['id'];

    $sql = "DELETE FROM libros WHERE id=$bookId";

    try {
        $conn->exec($sql);
        echo json_encode(['message' => 'Libro eliminado con éxito']);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al eliminar el libro: ' . $e->getMessage()]);
    }
}
?>
