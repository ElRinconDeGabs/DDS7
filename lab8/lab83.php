<!DOCTYPE html>
<html>
<head>
    <title>Llenar Arreglo con Números Pares</title>
</head>
<body>
    <h1>Llenar Arreglo con Números Pares</h1>

    <form method="POST" action="lab44.php">
        <label for="numero">Ingrese un número:</label>
        <input type="number" id="numero" name="numero" required>
        <input type="submit" value="Agregar número">
    </form>

    <?php
    $arreglo = array();
    $cantidadElementos = 20; // Cambia la cantidad de elementos según tus necesidades

    // Manejo del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = intval($_POST["numero"]);

        if ($numero % 2 == 0) {
            $arreglo[] = $numero; // Agregar el número par al arreglo
        } else {
            echo "El número ingresado no es par. Introduzca un número par.\n";
        }
    }

    // Mostrar el arreglo
    echo "<p>Arreglo:</p>";
    echo "<pre>";
    print_r($arreglo);
    echo "</pre>";

    // Verificar si el arreglo está completo
    if (count($arreglo) < $cantidadElementos) {
        echo "<p>Ingrese más números para completar el arreglo.</p>";
    } else {
        echo "<p>El arreglo está completo.</p>";
    }
    ?>
    
</body>
</html>
