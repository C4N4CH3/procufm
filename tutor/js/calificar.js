$(document).ready(function(){  
});

function aprobar(id){
    confirmar = confirm("¿Seguro que desea APROBAR?");
    if (confirmar) {            
            $.post("controlador.php", {opc: 'aprobarAl', val: id},
            function (data) {
                alert(data);            
                var url = "tutorCalificar.php"; 
                $(location).attr('href',url);
                //$('#info').fadeIn(1000).html(data);
            });
    } else {
        return false;
    } 
}

function reprobar(id){
    confirmar = confirm("¿Seguro que desea REPROBAR?");
    if (confirmar) {
            $.post("controlador.php", {opc: 'reprobarAl', val: id},
            function (data) {
                alert(data);            
                var url = "tutorCalificar.php"; 
                $(location).attr('href',url);
                //$('#info').fadeIn(1000).html(data);
            });
    } else {
        return false;
    } 
}