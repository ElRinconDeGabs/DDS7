function updateBookStatus(bookId, newStatus) {
    $.ajax({
        url: 'api.php',
        method: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify({
            id: bookId,
            estado: newStatus
        }),
        success: function(response) {
            console.log("Libro actualizado con éxito.");
            // Puedes actualizar solo la parte de la interfaz que ha cambiado en lugar de recargar toda la página
            // Por ejemplo, puedes mover el elemento en la interfaz según el nuevo estado
        },
        error: function(error) {
            console.error("Error al actualizar el libro:", error);
        }
    });
}

$(document).ready(function() {
    $(".kanban-block").sortable({
        connectWith: ".kanban-block",
        update: function(event, ui) {
            var bookId = ui.item.attr("id").split("-")[1]; // Obtiene el ID del libro
            var targetKanbanBlock = ui.item.parent().attr("id");

            // Obtiene el estado actual del libro
            var currentState = ui.item.data("estado");
            var newStatus; // Inicializa newStatus

            if (targetKanbanBlock === "por-leer") {
                newStatus = 'Por Leer';
            } else if (targetKanbanBlock === "leyendo" && currentState !== 'Leyendo') {
                newStatus = 'Leyendo';
            } else if (targetKanbanBlock === "leido" && currentState !== 'Leido') {
                newStatus = 'Leido';
            }

            if (newStatus) {
                updateBookStatus(bookId, newStatus);
                console.log("bookId: " + bookId);
                console.log("targetKanbanBlock: " + targetKanbanBlock);
                console.log("currentState: " + currentState);
                console.log("newStatus: " + newStatus);
            }
        }
    });

    $(".kanban-block").disableSelection();
});
