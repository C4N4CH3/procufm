$(document).ready(function(){
    $("#aprobado").click(function(){
        confirmar = confirm("¿Seguro que desea APROBAR?");
        if (confirmar) {        
            $.post("controlador.php", {opc: 'aprobarInforme', val: $("#id").val()},
            function (data) {
                alert(data);            
                var url = "tutorInformesPasantias.php"; 
                $(location).attr('href',url);
                /*$('#info').fadeIn(1000).html(data);*/
            });
        } else {
            return false;
        }                 
    });
    
    $("#reprobado").click(function(){
        confirmar = confirm("¿Seguro que desea REPROBAR?");
        if (confirmar) {  
            $.post("controlador.php", {opc: 'reprobarInforme', val: $("#id").val()},
            function (data) {                        
                alert(data);
                var url = "tutorInformesPasantias.php"; 
                $(location).attr('href',url);
            });
        } else {
            return false;
        }         
    });    
});