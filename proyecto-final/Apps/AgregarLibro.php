<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../Connect.php';

    $titulo = $_POST['libro-titulo'];
    $autor = $_POST['libro-autor'];
    $genero = $_POST['libro-genero'];
    $anio_publicacion = $_POST['libro-anio-publicacion'];

    try {
        // Llamada al procedimiento almacenado
        $sql = "CALL AgregarLibro(:titulo, :autor, :genero, :anio_publicacion)";
        $stmt = $conn->prepare($sql);

        // Asignar valores a los parámetros
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':anio_publicacion', $anio_publicacion);

        // Ejecutar la consulta preparada
        $stmt->execute();

        header("Location: ../index.php?mess=success");
    } catch (PDOException $e) {
        if ($e->getCode() == '45000') {
            // Código específico para manejar la excepción de duplicados
            header("Location: ../index.php?mess=duplicate");
        } else {
            // Otra excepción de PDO
            header("Location: ../index.php?mess=error");
        }
    } finally {
        $stmt->closeCursor(); // Cerrar el cursor para permitir la ejecución del siguiente CALL
        $conn = null;
        exit();
    }
} else {
    header("Location: ../index.php?mess=error");
}
?>
