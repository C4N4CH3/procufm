// JavaScript Document
$(document).ready(function () {      
    $('#nombreusuario').blur(function(){        
        var us=$(this).val();
        if(us!='' && us.length>=4){
            $.post("../includes/controlador_menu.php", {opc: 'comprobarLogin', login: $(this).val()},
            function (data) {
                $('#info').fadeIn(1000).html(data);
            });
        }else{
            $('#info').fadeIn(1000).html('');
        }
        
    });          
    
    $('.mayuscula').keyup(function(){
        if ($(this).val() != '')
            $(this).val($(this).val().toUpperCase());
    });
    
    
});