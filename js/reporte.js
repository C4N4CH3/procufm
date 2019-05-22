$(document).ready(function () {
    $("#buscar").click(function(){
        var val = $("#lapso").val();
        var id_estatus = $("#id_estatus").val();
        var car = $("#carrera").val();
        var men = $("#mencion").val();
        nuevo(val,id_estatus, car, men);
    });
    $('.carrera').change(function () {
        $.post("../includes/controlador_menu.php", {opc: 'mencion', car: $(this).val()},
        function (data) {
            var $op = "";
            /*alert(data);*/
            var dataJson = eval(data);
            $op += '<option value="">SELECCIONE</option>';
            for (var i in dataJson) {
                $op += '<option value="' + dataJson[i].id_mencion + '">' + dataJson[i].nombre_mencion + '</option>';
            }
            $('.mencion').html($op);
        });
    });

});

function nuevo(id_lapso, id_estatus, car, men) {
    /*alert(enviada);
    $("#todosreg").hide();
    $(".oculto").show();*/
    valores = ({id_lapso: id_lapso,
                id_estatus: id_estatus,
                id_carrera: car,
                id_mencion:men});
    $.post("../includes/controlador_reporte.php", {opc: 'cargaReporte', valores: valores},
    function (data) {
        /*$("input:hidden[name=id_al_hidden]").val(id);*/
        $("#mostar_tabla").html(data);
    });
}