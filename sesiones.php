<?php
//echo 'estoy en sesiones.php';
//Inicio la sesion
session_start();

//PROBAR A VER Q TAL
/*if(!isset($_SESSION['autentificado'])){
    header("Location: http://localhost/pasantia/index.php");
    exit();
}*/

//echo '$_SERVER[PHP_SELF]: localhost/' . $_SERVER['PHP_SELF'] . '<br />';
//echo 'Dirname($_SERVER[PHP_SELF]: ' . dirname($_SERVER['PHP_SELF']) . '<br>';

if($_SESSION['autentificado'] != "si" || !isset($_SESSION['autentificado'])) 
{   
    UNSET($_SESSION["autentificado"]);
    session_unset();
    session_destroy();    
    header("Location: http://localhost/pasantia/index.php");
    echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";
    exit();
}

/*if(!isset()){
    //echo "<script> document.location.href = \"../login.php\" </script>";
    header("Location: index.php");
}*/

?> 