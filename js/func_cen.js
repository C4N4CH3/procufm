// JavaScript Document
$(document).ready(function () {
    
    /*$("#nvoform").click(function() {
        $("#todosreg").hide();
    });
    
    
    $("#buscar_al").click(function() {
        alert("Bien");	
    });
     */
    
    valores = ({id_al: id,
        ira_al: ira
    });

    $.post("../includes/controlador_menu.php", {opc: 'cargaCentro', valores: valores},
    function (data) {
        /*$("input:hidden[name=id_al_hidden]").val(id);*/
        $("#mi_div").html(data);
    });

});


function nuevo(id,ira){
    alert(enviada);
    
        
}

        