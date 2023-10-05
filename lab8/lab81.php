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
    class FactorialCalculator {
        private $numero;
        
        public function __construct($numero) {
            $this->numero = intval($numero);
        }
        
        public function calcularFactorial() {
            $factorial = 1;
            for ($i = 1; $i <= $this->numero; $i++) {
                $factorial *= $i;
            }
            return $factorial;
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = $_POST["numero"];
        
        // Crear una instancia de FactorialCalculator
        $calculadora = new FactorialCalculator($numero);
        
        // Calcular el factorial
        $factorial = $calculadora->calcularFactorial();
        
        echo "<h2>Resultado:</h2>";
        echo "<p>El factorial de $numero es: $factorial</p>";
    }
    ?>
</body>
</html>
