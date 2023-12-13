<?php
// Incluye el archivo de conexión a la base de datos
require '../Connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera los datos del formulario de edición
        $titulo = $_POST['libro-titulo'];
        $autor = $_POST['libro-autor'];
        $genero = $_POST['libro-genero'];
        $anio_publicacion = $_POST['libro-anio-publicacion'];

        // Actualiza los datos del libro en la base de datos
        $sql = "UPDATE libros SET titulo = ?, autor = ?, genero = ?, anio_publicacion = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute([$titulo, $autor, $genero, $anio_publicacion, $id])) {
            // Libro actualizado con éxito, redirige de vuelta a la vista de libros
            header("Location: ../index.php");
        } else {
            echo "Error al actualizar el libro.";
        }
    } else {
        // Consulta para seleccionar el libro por su ID
        $sql = "SELECT * FROM libros WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $libro = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$libro) {
            echo "Libro no encontrado.";
            exit();
        }

        // Formulario para editar el libro
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Editar Libro</title>
            <link rel="stylesheet" type="text/css" href="../css/edit.css"> 
        </head>
        <body>
            <div class="card">
                <h2>Editar Libro</h2>
                <form method="POST">
                    <input type="text" name="libro-titulo" value="<?php echo $libro['titulo']; ?>" placeholder="Título del libro">
                    <input type="text" name="libro-autor" value="<?php echo $libro['autor']; ?>" placeholder="Autor del libro">
                    <input type="text" name="libro-genero" value="<?php echo $libro['genero']; ?>" placeholder="Género del libro">
                    <input type="text" name="libro-anio-publicacion" value="<?php echo $libro['anio_publicacion']; ?>" placeholder="Año de publicación">
                    <input type="submit" value="Guardar Cambios">
                </form>
            </div>
        </body>
        </html>
        <?php
    }
} else {
    echo "ID de libro no proporcionado.";
}
