<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Matriz Tipo Borde</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        #container {
            text-align: center;
            padding: 20px;
        }

        #title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        #matriz {
            display: inline-block;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            margin: 0 auto;
        }

        td {
            width: 40px;
            height: 40px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid black;
            background-color: #fff;
        }

        tr:first-child td,
        tr:last-child td,
        td:first-child,
        td:last-child {
            background-color: #e0e0e0;
            font-weight: bold;
        }

        #suma {
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div id="container">
        <div id="title">
            Generador de Matriz Tipo Borde
        </div>
        <form method="post">
            <label for="tamano">Tamaño de la matriz (par):</label>
            <input type="number" id="tamano" name="tamano" min="2" step="2" required>
            <input type="submit" value="Generar">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $n = $_POST["tamano"]; // Obtener el tamaño de la matriz ingresado por el usuario
            $sumaBorde = 0; // Variable que almacena la suma

            if ($n % 2 == 0) {
                echo '<div id="matriz">';

                // Creamos la tabla
                echo '<table>';
                for ($i = 0; $i < $n; $i++) {
                    echo '<tr>';
                    for ($j = 0; $j < $n; $j++) {
                        //  Variable que almacena el random
                        $valor = 0;

                        // Comprobar si estamos en el borde
                        if ($i == 0 || $i == $n - 1 || $j == 0 || $j == $n - 1) {
                            // Generar un valor aleatorio entre 0 y 100
                            $valor = rand(0, 100);
                            // Hacemos la suma uno por uno si estamos en el borde
                            $sumaBorde += $valor;
                        }

                        echo '<td>' . $valor . '</td>';
                    }
                    echo '</tr>';
                }
                // cerramos la tabla y mostramo la suma de los bordes
                echo '</table>';
                echo '</div>';
                echo '<div id="suma">';
                echo 'Suma de los valores en el borde: ' . $sumaBorde;
                echo '</div>';
            } else {
                // En caso que no ingrese un numero par mostramos un mensje de error
                echo '<div id="suma">';
                echo 'El tamaño de la matriz debe ser un número par.';
                echo '</div>';
            }
        }
        ?>
    </div>
</body>
</html>
