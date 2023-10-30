<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo DataTable JQuery</title>
    <link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="jquery-3.1.1.js"></script>
    <script type="text/javascript" language="javascript" src="jquery.dataTables.min.js"></script>
</head>
<body>
<script type="text/javascript">
        $(document).ready(function() {
            $('#grid').DataTable({
                "lengthMenu": [5, 10, 20, 50],
                "order": [[0, "asc"]],                   
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "zeroRecords": "No existen resultados en su busqueda",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(Buscado entre _MAX_ registros en total)",
                    "search": "Buscar: ",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior",
                    },
                }              
            });
            $("*").css("font-family", "arial").css('font-size', '12px');
        });
       
    </script>
    <h1>Consulta de noticias</h1>
    <?php
    require_once("class/noticias.php");

    $obj_noticia = new noticia();
    $noticias = $obj_noticia->consultar_noticias();

    $nfilas = count($noticias);

    if ($nfilas > 0) {
       echo "<table id='grid' class='display' cellspacing='0'>";
       echo "<thead>";
       echo "<tr>";
       echo "<th>Titulo</th>";
       echo "<th>Texto</th>";
       echo "<th>Categoria</th>";
       echo "<th>Fecha</th>";
       echo "<th>Imagen</th>";
       echo "</tr>";
       echo "</thead>";

       echo "<tbody>";

       foreach ($noticias as $resultado) {
           echo "<tr>";
           echo "<td>" . $resultado['titulo'] . "</td>";
           echo "<td>" . $resultado['texto'] . "</td>";
           echo "<td>" . $resultado['categoria'] . "</td>";
           echo "<td>" . date("j/n/Y", strtotime($resultado['fecha'])) . "</td>";

           if ($resultado['imagen'] != "") {
               echo "<td><a target='_blank' href='img/" . $resultado['imagen'] . "'><img border='0' src='img/iconotexto.gif'></a></td>";
           } else {
               echo "<td>&nbsp;</td>";
           }
           echo "</tr>";
       }

       echo "</tbody>";
       echo "</table>";
    } else {
        echo "No hay noticias disponibles";
    }
    ?>   
</body>
</html>
