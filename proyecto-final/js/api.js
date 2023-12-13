$(document).ready(function () {
    // Obtener datos de la API al cargar la página
    $.ajax({
        url: 'api.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log("Datos de la API:", data);
            mostrarDatos(data);
        },
        error: function (error) {
            console.error('Error al obtener datos de la API:', error);
        }
    });

    // Función para mostrar los datos en la página
    function mostrarDatos(libros) {


        // Iterar sobre los libros y mostrarlos en los contenedores correspondientes
        $.each(libros, function (index, libro) {
            var libroHTML = '<div class="libro" draggable="true" ondragstart="drag(event)" id="libro-' + libro.id + '" data-estado="' + libro.estado + '">';
            libroHTML += '<p>Título: ' + libro.titulo + '</p>';
            libroHTML += '<p>Autor: ' + libro.autor + '</p>';
            libroHTML += '<p>Género: ' + libro.genero + '</p>';
            libroHTML += '<p>Año de Publicación: ' + libro.anio_publicacion + '</p>';
            libroHTML += '<a href="#" class="btn-eliminar" onclick="eliminarLibro(' + libro.id + ')">Eliminar</a>';
            libroHTML += '<a href="./Apps/Edit.php?id=' + libro.id + '" class="btn-editar">Editar</a>';
            libroHTML += '</div>';

            // Agregar libro al contenedor correspondiente según su estado
            if (libro.estado === 'Por leer') {
                $('#por-leer').append(libroHTML);
            } else if (libro.estado === 'Leyendo') {
                $('#leyendo').append(libroHTML);
            } else if (libro.estado === 'Leido') {
                $('#leido').append(libroHTML);
            }
        });
    }
});


// Función para eliminar un libro
function eliminarLibro(libroId) {
    $.ajax({
        url: 'Apps/Delete.php',
        type: 'DELETE',
        dataType: 'json',
        data: JSON.stringify({ id: libroId }),
        contentType: 'application/json',
        success: function (response) {
            console.log(response.message);
            location.reload();
        },
        error: function (error) {
            console.error('Error al eliminar el libro:', error);
        }
    });
}

// Evento de clic en el botón de eliminar
$('.btn-eliminar').on('click', function () {
    var libroId = $(this).data('libroid');
    eliminarLibro(libroId);
});

