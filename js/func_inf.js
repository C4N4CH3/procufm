// JavaScript Document
function eliminar(id_inf,id_ins){    
    $(document).ready(function () {
        confirmar = confirm("¿Seguro que Desea eliminar?");
        if (confirmar) {
            valores = ({id_ins:id_ins,
                    id_inf:id_inf
                });
            
            $.post("../includes/controlador_menu.php", {opc: 'eliminarInf', valores: valores},
            function (data) {
                alert(data);
                location.reload();
            });
        } else {
            return false;
        }

    });
}
