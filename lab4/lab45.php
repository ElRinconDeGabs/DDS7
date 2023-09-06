<!DOCTYPE html>
<html>

<head>
    <title>Llenar Arreglo con Números Pares</title>
</head>

<body>
    <h1>Llenar Arreglo con Números Pares</h1>

    <ul id="arreglo">
        <?php
        $arreglo = array();
        $cantidadElementos = 5;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numero = intval($_POST["numero"]);

            if ($numero % 2 === 0) {
                $arreglo[] = $numero;
            } else {
                echo "<p>El número ingresado ($numero) no es par. Introduzca un número par.</p>";
            }
        }
        foreach ($arreglo as $valor) {
            echo "<li>$valor</li>";
        }
        ?>
    </ul>

    <?php
    if (count($arreglo) < $cantidadElementos) {
    ?>
        <form method="POST" action="">
            <label for="numero">Ingrese un número par:</label>
            <input type="number" id="numero" name="numero" required>
            <input type="submit" value="Agregar número">
        </form>
    <?php
    } else {
        echo "<p>Se han ingresado $cantidadElementos números pares.</p>";
    }
    ?>
</body>

</html>