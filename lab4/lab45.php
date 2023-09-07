<!DOCTYPE html>
<html>
<head>
    <title>Generar Matriz Identidad</title>
</head>
<body>
    <h1>Generar Matriz Identidad</h1>
    
    <form method="POST" action="">
        <label for="n">Ingrese el valor de N (número par):</label>
        <input type="number" id="n" name="n" required>
        <input type="submit" value="Generar Matriz">
    </form>

    <?php
    function generarMatrizIdentidad($n) {
        $matriz = array();
        
        for ($i = 0; $i < $n; $i++) {
            $fila = array();
            
            for ($j = 0; $j < $n; $j++) {
                if ($i == $j) {
                    $fila[] = 1; // Elementos de la diagonal principal son 1
                } else {
                    $fila[] = 0; // Otros elementos son 0
                }
            }
            
            $matriz[] = $fila;
        }
        
        return $matriz;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $n = intval($_POST["n"]);

        if ($n % 2 == 0) { // Verificar si N es un número par
            $matrizIdentidad = generarMatrizIdentidad($n);
            
            // Mostrar la matriz identidad
            echo "<h2>Matriz Identidad de Orden $n:</h2>";
            echo "<pre>";
            foreach ($matrizIdentidad as $fila) {
                echo implode(" ", $fila) . "<br>";
            }
            echo "</pre>";
        } else {
            echo "<p>Por favor, ingrese un número par.</p>";
        }
    }
    ?>
</body>
</html>
