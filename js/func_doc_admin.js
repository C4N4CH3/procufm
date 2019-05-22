// JavaScript Document
function eliminar(id){    
    $(document).ready(function () {
        confirmar = confirm("¿Seguro que Desea eliminar?");
        if (confirmar) {
            $.post("../includes/controlador_menu.php", {opc: 'eliminarDoc', id: id},
            function (data) {
                alert(data);
                location.reload();
            });
        } else {
            return false;
        }

    });
}