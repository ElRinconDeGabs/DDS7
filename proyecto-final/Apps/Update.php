<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["bookId"]) && isset($_POST["newState"])) {
    require '../Connect.php';

    $bookId = $_POST["bookId"];
    $newState = $_POST["newState"];

    // Valida que $bookId sea un número entero válido (puedes agregar más validaciones según sea necesario)
    if (!is_numeric($bookId)) {
        echo "Error: ID de libro no válido.";
    } else {
        // Actualiza el estado del libro en la base de datos
        $sql = "UPDATE libros SET estado = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([$newState, $bookId])) {
            echo "Libro actualizado con éxito.";
        } else {
            echo "Error al actualizar el libro: " . implode(', ', $stmt->errorInfo());
        }
    }
} else {
    echo "Error: Parámetros faltantes o solicitud incorrecta.";
}
?>
