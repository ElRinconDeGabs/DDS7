<?php
require '../Connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Eliminar un libro
    $data = json_decode(file_get_contents("php://input"), true);
    $libroId = $data['id'];

    $sql = "DELETE FROM libros WHERE id=?";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$libroId]);
        echo json_encode(['message' => 'Libro eliminado con éxito']);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al eliminar el libro: ' . $e->getMessage()]);
    }
} else {
    echo "Método de solicitud no permitido.";
}

// Cierra la conexión a la base de datos
$conn = null;
?>
