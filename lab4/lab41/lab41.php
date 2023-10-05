<!DOCTYPE html>
<html>
<head>
    <title>Selector de Imágenes</title>
</head>
<body>
    <h1>Imágenes basado en el Indicador de Ventas</h1>
    
    <form method="POST" action="lab41.php">
        <label for="indicador">Indicador de Ventas:</label>
        <input type="number" id="indicador" name="indicador" required>
        <input type="submit" value="Mostrar Imagen">
    </form>
    
    <?php
    // Manejo del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener el valor del indicador de ventas
        $indicador = intval($_POST["indicador"]);
        
        // Determinar qué imagen mostrar según el rango del indicador
        if ($indicador >= 80 && $indicador <= 100) {
            $imagen = "verde.png";
        } elseif ($indicador >= 50 && $indicador <= 79) {
            $imagen = "amarillo.png";
        } else {
            $imagen = "rojo.png";
        }
        
        // Verificar si la imagen existe antes de mostrarla
        if (file_exists($imagen)) {
    ?>
    
    <h2>Imagen Seleccionada:</h2>
    <img src="<?php echo $imagen; ?>" alt="Imagen Seleccionada">
    
    <?php
        } else {
            echo "<p>La imagen no se encuentra disponible.</p>";
        }
    }
    ?>
</body>
</html>
