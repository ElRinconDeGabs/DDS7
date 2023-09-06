<!DOCTYPE html>
<html>
<head>
    <title>Elemento Mayor en un Arreglo</title>
</head>
<body>
    <h1>Elemento Mayor en un Arreglo</h1>
    
    <?php
    // Llenar el arreglo con valores diferentes
    $arreglo = array();
    for ($i = 0; $i < 20; $i++) {
        $valor = rand(1, 100); // Generar un valor aleatorio entre 1 y 100
        while (in_array($valor, $arreglo)) {
            $valor = rand(1, 100); // Si el valor ya existe en el arreglo, generar uno nuevo
        }
        $arreglo[$i] = $valor;
    }
    
    // Encontrar el elemento mayor y su posición
    $maximo = max($arreglo);
    $posicionMaximo = array_search($maximo, $arreglo);
    
    echo "<p>Elemento Mayor:</p>";
    echo "<p>Valor: $maximo</p>";
    echo "<p>Posición: $posicionMaximo</p>";
    ?>
</body>
</html>
