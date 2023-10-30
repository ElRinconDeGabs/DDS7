<?php
session_start();

if (isset($_REQUEST['usuario']) && isset($_REQUEST['clave'])) {
    $usuario = $_REQUEST["usuario"];
    $clave   = $_REQUEST["clave"];

    $salt = substr($usuario, 0, 2);
    $clave_crypt = crypt($clave, $salt);

    require_once("class/usuarios.php");
    $obj_usuarios = new Usuarios(); // Corregido el nombre de la clase
    $usuario_valido = $obj_usuarios->validar_usuario($usuario, $clave_crypt);

    $nfilas = 0; // Inicializar $nfilas

    foreach ($usuario_valido as $array_resp) {
        foreach ($array_resp as $value) {
            $nfilas = $value;
        }
    }

    if ($nfilas > 0) {
        $usuario_valido = $usuario;
        $_SESSION["usuario_valido"] = $usuario_valido;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 14 Login al sitio de noticias</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <?php
    // Sesión iniciada (Corregido el nombre de la variable)
    if (isset($_SESSION["usuario_valido"])) {
        ?>
        <h1>Gestión de noticias</h1>
        <hr>
        <ul>
            <li><a href="Laboratorio14.2.php">Listar todas las noticias</a></li>
            <li><a href="Laboratorio14.3.php">Listar noticias por partes</a></li>
            <li><a href="Laboratorio14.4.php">Buscar noticias</a></li>
        </ul>
        <hr>
        <p>[ <a href='logout.php'>Desconectar</a>]</p>
        <?php
    }
    // Intento de entrada fallido
    else if (isset($usuario)) {
        print ("<br><br>\n");
        print ("<p align='CENTER'>Acceso no autorizado</p>\n");
        print ("<p align='CENTER'>[<a href='login.php'>Conectar</a>]</p>\n");
    }
    // Sesión no iniciada
    else {
        print ("<br><br>\n");
        print ("<h1>Gestión de noticias</h1>");
        print ("<p class='parrafocentrado'>Esta zona tiene el acceso restringido.<br>" .
               "Para entrar debe identificarse.</p>\n");
               print("<form class='entrada' name='login' action='login.php' method='post'>\n");
               print("    <div class='form-group'>\n");
               print("        <label for='usuario' class='etiqueta-entrada'>Usuario:</label>\n");
               print("        <input type='text' name='usuario' id='usuario' size='15'>\n");
               print("    </div>\n");
               
               print("    <div class='form-group'>\n");
               print("        <label for='clave' class='etiqueta-entrada'>Clave:</label>\n");
               print("        <input type='password' name='clave' id='clave' size='15'>\n");
               print("    </div>\n");
               
               print("    <div class='form-group'>\n");
               print("        <input type='submit' value='Entrar'>\n");
               print("    </div>\n");
               print("</form>\n");
               

        print ("<p class='parrafocentreado'>NOTA: si no dispone de identificación o tiene problemas " .
               "para entrar<br>póngase en contacto con el " .
               "<a href='mailto:webmaster@localhost'>administrador</a> del sitio</p>\n");
    }
    ?>
</div>
</body>
</html>
