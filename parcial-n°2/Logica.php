<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Sumatoria</title>
</head>
<body>
    <h2>Calculadora de Sumatoria</h2>

    <form action="" method="post">
        <label for="n">Ingrese el valor de n:</label>
        <input type="number" name="n" value="<?php echo isset($_POST['n']) ? htmlspecialchars($_POST['n']) : ''; ?>" required>
        <button type="submit">Calcular</button>
    </form>

    <?php
    include_once 'ConexionBD.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener el valor de n desde el formulario
        $n = intval($_POST['n']);

        try {
            $conexion = new ConexionBD();
            $conn = $conexion->obtenerConexion();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Inicializar factorial y sumatoria
            $factorial = 1;
            $sumatoria = 0;

            for ($i = 1; $i <= $n; $i++) {
                $factorial *= $i;
                $sumatoria += ($n + 1 - $i) / $factorial;

                // Insertar en la tabla parcial2
                $stmtInsertar = $conn->prepare("INSERT INTO parcial2 (n, factorial, sumatoria) VALUES (?, ?, ?)");
                $stmtInsertar->bindParam(1, $n, PDO::PARAM_INT);
                $stmtInsertar->bindParam(2, $factorial, PDO::PARAM_INT);
                $stmtInsertar->bindParam(3, $sumatoria, PDO::PARAM_STR);
                $stmtInsertar->execute();
            }

            echo "<h3>Resultado:</h3>";
            echo "<p>Sumatoria para n = $n: $sumatoria</p>";

            echo "<h3>Resultados anteriores:</h3>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>n</th><th>Factorial</th><th>Sumatoria</th></tr>";

            $stmtObtener = $conn->query("SELECT * FROM parcial2");

            while ($row = $stmtObtener->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>{$row['id']}</td><td>{$row['n']}</td><td>{$row['factorial']}</td><td>{$row['sumatoria']}</td></tr>";
            }

            echo "</table>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // Cerrar la conexión
            $conexion->cerrarConexion();
        }
    }
    ?>
</body>
</html>
