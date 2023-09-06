<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Factorial</title>
</head>
<body>
    <h1>Calculadora de Factorial</h1>
    
    <form method="POST" action="lab42.php">
        <label for="numero">Ingrese un número:</label>
        <input type="number" id="numero" name="numero" required>
        <input type="submit" value="Calcular Factorial">
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = intval($_POST["numero"]);
        
        // Calcular el factorial
        $factorial = 1;
        for ($i = 1; $i <= $numero; $i++) {
            $factorial *= $i;
        }
        
        echo "<h2>Resultado:</h2>";
        echo "<p>El factorial de $numero es: $factorial</p>";
    }
    ?>
</body>
</html>
