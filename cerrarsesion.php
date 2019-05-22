<?php
    session_start();
    //UNSET($_SESSION["autentificado"]);
    //session_unset();
    //session_destroy();    
    //echo '<script type="text/javascript">javascript:window.location="index.php?salirsesion=si"</script>';
    //var_dump($_SESSION);
    //die;
    include ("conexionbd.php");   
    $usuariobd = $_SESSION['usuario'];
    $sql = "update usuario set ip_session =NULL where login='$usuariobd'"; 
    $result = mysql_query($sql);
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php?salirsesion=si");
?>
