<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio13</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <h1>Recuperar valor de una Cookie</h1>
    <?php

    if
    (isset($_COOKIE["user"]))
    echo "<H2>Bienvenido ".$_COOKIE["user"]."!</H2><br/>";
    else
    echo
    "<H2>Bienvenido invitado</H2><br/>";
    ?>
    <a href="Laboratorio13.1.php">...Regresar</a>&nbsp;
    <a href="Laboratorio13.4.php">Continuar...</a>
</body>
</html>