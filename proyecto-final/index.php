<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Book Tracker</title>
    <link rel="stylesheet" href="./css/estilos.css">
</head>

<body>

    <!-- Agrega el botón de logout -->
    <div class="logout-container">
        <a href="Logout.php" class="btn-logout">Logout</a>
    </div>


    <div class="container">
        <div class="kanban-head">
            <strong class="kanban-head-title">Mi lista de Libros</strong>
        </div>

        <div class="kanban-table">
            <div class="kanban-form-container">
                <form id="kanban-form" action="Apps/AgregarLibro.php" method="POST">
                    <div class="kanban-form">
                        <strong class="kanban-form-title">Agregar Libro</strong>
                        <br>
                        <div class="container-inputs">
                            <strong class="strong-input">Título del Libro: </strong>
                            <input type="text" name="libro-titulo" class="input-text">
                            <strong class="strong-input">Autor del Libro: </strong>
                            <input type="text" name="libro-autor" class="input-text">
                            <strong class="strong-input">Género del Libro: </strong>
                            <input type="text" name="libro-genero" class="input-text">
                            <strong class="strong-input">Año de Publicación: </strong>
                            <input type="text" name="libro-anio-publicacion" class="input-text">

                            <!-- Agrega un campo oculto para el estado predeterminado -->
                            <input type="hidden" name="libro-estado" value="Por leer">
                        </div>
                        <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                            <p id="error-message" style="color: #ff6666;">Todos los campos son obligatorios.</p>
                        <?php } ?>
                        <input class="btn-crear" id="btn-crear-editar" type="submit" value="Agregar Libro" />
                    </div>
                </form>

                </form>
            </div>
            <div class="kanban-block" id="por-leer" ondrop="drop(event, 'Por Leer')" ondragover="allowDrop(event)">
                <strong class="kanban-form-title">POR LEER</strong>
                <!-- Contenedor de libros por leer -->
            </div>
            <div class="kanban-block" id="leyendo" ondrop="drop(event, 'Leyendo')" ondragover="allowDrop(event)">
                <strong class="kanban-form-title">LEYENDO</strong>
                <!-- Contenedor de libros que estás leyendo -->
            </div>
            <div class="kanban-block" id="leido" ondrop="drop(event, 'Leído')" ondragover="allowDrop(event)">
                <strong class="kanban-form-title">LEÍDO</strong>
                <!-- Contenedor de libros leídos -->
            </div>
        </div>
    </div>

    <script type="text/javascript" charset="utf-8" src="./js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="./js/jquery-ui.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="./js/api.js"></script>
</body>

</html>