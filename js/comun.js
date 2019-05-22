// JavaScript Document
$(document).ready(function () {      
    /*$('#info').fadeIn(1000).html('');*/
    $('.mayuscula').keyup(function(){
        if ($(this).val() != '')
            $(this).val($(this).val().toUpperCase());
    });
});