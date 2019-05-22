<?php
include_once'../sesiones.php';
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cronograma</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php include_once '../navbar.php';?>
  <div class="sidebar1"> 
    <?php include_once("menu_admin.php")?>
  <!-- end .sidebar1 --></div>
  <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
    <h2 align="center">Cronograma</h2>
    
    <fieldset style="width: 80%; border: 1px solid;width: 400px; margin:auto;">
        <legend>MENU</legend>
        <form action="" method="post">            
            <br>Ver Registros:<input type="submit" name="btn1" value="Listar" id="vertodos" />
            <br>Para Nuevo registro: <a href='#nuevo' class='iredit' onClick='nuevo()'>Nuevo</a>        
        </form> 
    </fieldset>
    <br><br>
<?php
if (isset($_POST["btn1"])) {
    $btn = $_POST["btn1"];

    if ($btn == "Listar") {
        require_once '../Connections/consultas.php';
        $consulta = new Consulta();              
       /*$sql = "SELECT * FROM 
                    (lapso as lap
                    INNER JOIN fecha_eventos as fev
                    ON lap.id_fecha_evento=fev.id_fecha_evento)
                    INNER JOIN fecha_actividades as fa
                    ON lap.codigo_lapso=fa.codigo_lapso";*/
        
        $sql = "SELECT * FROM lapso";           
        $cs = $consulta->consultas_bd($sql);
        
        echo"<div id='todosreg'><center>
            <br>REGISTROS<br>            
<table border='1' width='100%' id='mi_tabla'>
<thead>
<tr>
    <th colspan='8' align='right'><input type='text' id='filtrar' /></th>
</tr>
<tr>
<th>Codigo</th>
<th>Habilitado</th>
<th>Fecha Registro</th>
<th>Hab/Des</th>
<th>Id al editar</th>
</tr>
</thead>";
        echo "<tbody>";
        while ($resul = mysql_fetch_array($cs)) {
            $id = $resul["id_lapso"];            
            echo "<tr>";
            echo "<td>".$resul["codigo_lapso"]."</td>";
            echo "<td>".$resul["lapso_habilitado"]."</td>";
            echo "<td>".$resul["fecha_registro"]."</td>";
            echo "<td><a href='#cambia_estatus' class='iredit' onClick ='hab_des(".$id.")'>Cambiar</a></td>";
            echo "<td><a href='#editar' class='iredit' onClick ='editar(".$id.")'>Editar</a></td>";;            
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>
</center></div>";
    }
}
?> 
    
<?php
if (isset($_POST["enviar"])) {
    if (!empty($_POST['reunion_diurno']) && !empty($_POST['reunion_vesper'])      
            && !empty($_POST['reunion_nocturno']) && !empty($_POST['fecha_preinscripcion']) 
            && !empty($_POST['cod_lapso']) && !empty($_POST['fecha_tci1'])
            && !empty($_POST['fecha_tcc1']) && !empty($_POST['fecha_if1'])            
            && !empty($_POST['fecha_tci2']) && !empty($_POST['fecha_tcc2'])
            && !empty($_POST['fecha_if1']) && !empty($_POST['fecha_tci3']) 
            && !empty($_POST['fecha_tcc3']) && !empty($_POST['fecha_if3'])
             && !empty($_POST['fecha_tci4']) && !empty($_POST['fecha_tcc4'])
            && !empty($_POST['fecha_if4']) && !empty($_POST['fecha_mti1']) 
            && !empty($_POST['fecha_tcc4']) && !empty($_POST['fecha_if4'])
             && !empty($_POST['fecha_mti1']) && !empty($_POST['fecha_mtc1'])
            && !empty($_POST['fecha_mtif']) && !empty($_POST['fecha_li1']) 
            && !empty($_POST['fecha_lc1']) && !empty($_POST['fecha_lif1'])
             && !empty($_POST['fecha_li2']) && !empty($_POST['fecha_lc2'])
            && !empty($_POST['fecha_lif2']) && !empty($_POST['fecha_li3']) 
            && !empty($_POST['fecha_lc3']) && !empty($_POST['fecha_lif3'])){  
    
    
        $id = $_POST['id'];
        $id_fe_ev=$_POST['id_fe_ev'];        
        $reunion_diurno = $_POST['reunion_diurno'];
        $trozo = explode("-", $reunion_diurno);
        $reunion_diurno = $trozo[2].$trozo[1].$trozo[0];
        $reunion_vesper = $_POST['reunion_vesper'];
        $trozo = explode("-", $reunion_vesper);
        $reunion_vesper = $trozo[2].$trozo[1].$trozo[0];
        $reunion_nocturno = $_POST['reunion_nocturno'];
        $trozo = explode("-", $reunion_nocturno);
        $reunion_nocturno = $trozo[2].$trozo[1].$trozo[0];
        $fecha_preinscripcion = $_POST['fecha_preinscripcion'];
        $trozo = explode("-", $fecha_preinscripcion);
        $fecha_preinscripcion = $trozo[2].$trozo[1].$trozo[0];
        //tabla codigo de lapso
        $cod_lap = $_POST['cod_lapso'];
        //tabla fecha_actividades tiempo completo 1
        $id_fechatc1 = $_POST['id_fechatc1'];
        $fecha_tci1 = $_POST['fecha_tci1'];
        $trozo = explode("-", $fecha_tci1);
        $fecha_tci1 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_tcc1 = $_POST['fecha_tcc1'];
        $trozo = explode("-", $fecha_tcc1);
        $fecha_tcc1 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_if1 = $_POST['fecha_if1'];
        $trozo = explode("-", $fecha_if1);
        $fecha_if1 = $trozo[2].$trozo[1].$trozo[0];
        //tabla fecha_actividades tiempo completo 2
        $id_fechatc2 = $_POST['id_fechatc2'];
        $fecha_tci2 = $_POST['fecha_tci2'];
        $trozo = explode("-", $fecha_tci2);
        $fecha_tci2 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_tcc2 = $_POST['fecha_tcc2'];
        $trozo = explode("-", $fecha_tcc2);
        $fecha_tcc2 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_if2 = $_POST['fecha_if2'];
        $trozo = explode("-", $fecha_if2);
        $fecha_if2 = $trozo[2].$trozo[1].$trozo[0];
        //tabla fecha_actividades tiempo completo 3
        $id_fechatc3 = $_POST['id_fechatc3'];
        $fecha_tci3 = $_POST['fecha_tci3'];
        $trozo = explode("-", $fecha_tci3);
        $fecha_tci3 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_tcc3 = $_POST['fecha_tcc3'];
        $trozo = explode("-", $fecha_tcc3);
        $fecha_tcc3 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_if3 = $_POST['fecha_if3'];
        $trozo = explode("-", $fecha_if3);
        $fecha_if3 = $trozo[2].$trozo[1].$trozo[0];
        //tabla fecha_actividades tiempo completo 4
        $id_fechatc4 = $_POST['id_fechatc4'];
        $fecha_tci4 = $_POST['fecha_tci4'];
        $trozo = explode("-", $fecha_tci4);
        $fecha_tci4 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_tcc4 = $_POST['fecha_tcc4'];
        $trozo = explode("-", $fecha_tcc4);
        $fecha_tcc4 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_if4 = $_POST['fecha_if4'];
        $trozo = explode("-", $fecha_if4);
        $fecha_if4 = $trozo[2].$trozo[1].$trozo[0];
        //tabla fecha_actividades medio tiempo 1
        $id_fecha_mtil1 = $_POST['id_fecha_mtil1'];
        $fecha_mti1 = $_POST['fecha_mti1'];
        $trozo = explode("-", $fecha_mti1);
        $fecha_mti1 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_mtc1 = $_POST['fecha_mtc1'];
        $trozo = explode("-", $fecha_mtc1);
        $fecha_mtc1 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_mtif = $_POST['fecha_mtif'];
        $trozo = explode("-", $fecha_mtif);
        $fecha_mtif = $trozo[2].$trozo[1].$trozo[0];
        //tabla fecha_actividades pasantias largas 1
        $id_fecha_li1 = $_POST['id_fecha_li1'];
        $fecha_li1 = $_POST['fecha_li1'];
        $trozo = explode("-", $fecha_li1);
        $fecha_li1 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_lc1 = $_POST['fecha_lc1'];
        $trozo = explode("-", $fecha_lc1);
        $fecha_lc1 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_lif1 = $_POST['fecha_lif1'];
        $trozo = explode("-", $fecha_lif1);
        $fecha_lif1 = $trozo[2].$trozo[1].$trozo[0];
        //tabla fecha_actividades pasantias largas 2
        $id_fecha_li2 = $_POST['id_fecha_li2'];
        $fecha_li2 = $_POST['fecha_li2'];
        $trozo = explode("-", $fecha_li2);
        $fecha_li2 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_lc2 = $_POST['fecha_lc2'];
        $trozo = explode("-", $fecha_lc2);
        $fecha_lc2 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_lif2 = $_POST['fecha_lif2'];
        $trozo = explode("-", $fecha_lif2);
        $fecha_lif2 = $trozo[2].$trozo[1].$trozo[0];
        //tabla fecha_actividades pasantias largas 3
        $id_fecha_li3 = $_POST['id_fecha_li3'];
        $fecha_li3 = $_POST['fecha_li3'];
        $trozo = explode("-", $fecha_li3);
        $fecha_li3 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_lc3 = $_POST['fecha_lc3'];
        $trozo = explode("-", $fecha_lc3);
        $fecha_lc3 = $trozo[2].$trozo[1].$trozo[0];
        $fecha_lif3 = $_POST['fecha_lif3'];
        $trozo = explode("-", $fecha_lif3);
        $fecha_lif3 = $trozo[2].$trozo[1].$trozo[0];
                
        //PARA NUEVO REGISTRO
        if(empty($_POST['id'])){        
            include "../conexionbd.php";
            $consulta = "select * from lapso where codigo_lapso='$cod_lap'";
            $resultado = mysql_query($consulta) or die(mysql_error());

            if (mysql_num_rows($resultado) > 0) {
                //header("Location: formulariocronogramapasantia.php?codexistente=si");
                echo "Disculpe! Ya existe un registro con ese mismo codigo:\"" . $cod_lap . "\"";
            } else {
                $hoy = date("Y-n-j");
                $sql = "INSERT INTO fecha_eventos 
                                    (fecha_diurna, fecha_vespertino, fecha_nocturno, fecha_preins)
                                    VALUES ('$reunion_diurno','$reunion_vesper','$reunion_nocturno','$fecha_preinscripcion')";
                $reg_evento = mysql_query($sql) or die(mysql_error());
                $fecha_even_id = mysql_insert_id(); //realiza despues de un INSERT para capturar el id de una tabla

                /* $insertarEstad = "insert into estadistica (alumnos_aprobados,alumnos_reprobados)"."values ('0','0')";	
                  mysql_query($insertarEstad) or die(mysql_error());
                  $idEstad = mysql_insert_id(); */

                $sql1 = "INSERT INTO lapso 
                                (codigo_lapso, lapso_habilitado, id_fecha_evento, fecha_registro, id_estadistica)
                                VALUES ('$cod_lap','si','$fecha_even_id','$hoy',0)";

                $sql2 = "INSERT INTO fecha_actividades 
                                (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,
                                fecha_habilitado,tipo_pasantias, tipo_periodo) 
                               VALUES ('$cod_lap','$fecha_tci1','$fecha_tcc1','$fecha_if1','si','tiempo completo', 'tc1')";

                $sql3 = "INSERT INTO fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,
                                            fecha_infinal,fecha_habilitado,tipo_pasantias, tipo_periodo)
                                            VALUES ('$cod_lap','$fecha_tci2','$fecha_tcc2','$fecha_if2',
                                            'si','tiempo completo', 'tc2')";

                $sql4 = "INSERT INTO fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,
                                            fecha_habilitado,tipo_pasantias, tipo_periodo)
                                            VALUES ('$cod_lap','$fecha_tci3','$fecha_tcc3','$fecha_if3','si',
                                                    'tiempo completo', 'tc3')";

                $sql5 = "INSERT INTO fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,
                                            fecha_habilitado,tipo_pasantias, tipo_periodo)
                                            VALUES ('$cod_lap','$fecha_tci4','$fecha_tcc4','$fecha_if4','si',
                                                    'tiempo completo', 'tc4')";

                $sql6 = "INSERT INTO fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,
                                            fecha_habilitado,tipo_pasantias, tipo_periodo)
                                            VALUES('$cod_lap','$fecha_mti1','$fecha_mtc1','$fecha_mtif','si',
                                            'medio tiempo', 'mt1')";

                $sql7 = "INSERT INTO fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,
                                            fecha_habilitado,tipo_pasantias, tipo_periodo)
                                            VALUES('$cod_lap','$fecha_li1','$fecha_lc1','$fecha_lif1','si',
                                            'pasantia larga', 'pl1')";

                $sql8 = "INSERT INTO fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,
                                            fecha_habilitado,tipo_pasantias, tipo_periodo)
                                            VALUES ('$cod_lap','$fecha_li2','$fecha_lc2','$fecha_lif2','si',
                                            'pasantia larga', 'pl2')";

                $sql9 = "INSERT INTO fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,
                                            fecha_habilitado,tipo_pasantias, tipo_periodo)
                                            VALUES ('$cod_lap','$fecha_li3','$fecha_lc3','$fecha_lif3','si',
                                            'pasantia larga', 'pl3')";

                $res_fecha1 = mysql_query($sql1) or die(mysql_error());
                $res_fecha2 = mysql_query($sql2) or die(mysql_error());
                $res_fecha3 = mysql_query($sql3) or die(mysql_error());
                $res_fecha4 = mysql_query($sql4) or die(mysql_error());
                $res_fecha5 = mysql_query($sql5) or die(mysql_error());
                $res_fecha6 = mysql_query($sql6) or die(mysql_error());
                $res_fecha7 = mysql_query($sql7) or die(mysql_error());
                $res_fecha8 = mysql_query($sql8) or die(mysql_error());
                $res_fecha9 = mysql_query($sql9) or die(mysql_error());
                
                if ($reg_evento && $res_fecha1 && $res_fecha2 && $res_fecha3 && 
                        $res_fecha4 && $res_fecha5 && $res_fecha6 && $res_fecha7 
                        && $res_fecha8 && $res_fecha9) {
                    echo "<h2>Hemos recibido sus datos exitosamente </h2>";
                }
            }
            mysql_close($link);
        }else{
            //PARA ACTUALIZAR
            include "../conexionbd.php";
            $sql = "UPDATE fecha_eventos 
                        SET fecha_diurna='$reunion_diurno', fecha_vespertino='$reunion_vesper', 
                            fecha_nocturno='$reunion_nocturno', fecha_preins='$fecha_preinscripcion'
                        WHERE id_fecha_evento=".$id_fe_ev;
            $reg_evento = mysql_query($sql) or die(mysql_error());
            
            $sql1 = "UPDATE lapso 
                        SET codigo_lapso='$cod_lap'
                        WHERE id_lapso=".$id;
            
            $sql2 = "UPDATE fecha_actividades 
                        SET codigo_lapso='$cod_lap',fecha_inicio='$fecha_tci1',
                            fecha_culminacion='$fecha_tcc1',fecha_infinal='$fecha_if1'
                        WHERE id_fecha=".$id_fechatc1;

            $sql3 = "UPDATE fecha_actividades 
                        SET codigo_lapso='$cod_lap',fecha_inicio='$fecha_tci2',
                            fecha_culminacion='$fecha_tcc2', fecha_infinal='$fecha_if2'
                        WHERE id_fecha =".$id_fechatc2;
                                                
            $sql4 = "UPDATE fecha_actividades 
                        SET codigo_lapso='$cod_lap',fecha_inicio='$fecha_tci3',
                            fecha_culminacion='$fecha_tcc3',fecha_infinal='$fecha_if3'
                        WHERE id_fecha =".$id_fechatc3;
                
            $sql5 = "UPDATE fecha_actividades 
                        SET codigo_lapso='$cod_lap',fecha_inicio='$fecha_tci4',
                            fecha_culminacion='$fecha_tcc4',fecha_infinal='$fecha_if4'
                        WHERE id_fecha =".$id_fechatc4;
                
            $sql6 = "UPDATE fecha_actividades 
                        SET codigo_lapso='$cod_lap',fecha_inicio='$fecha_mti1',
                            fecha_culminacion='$fecha_mtc1',fecha_infinal='$fecha_mtif'
                        WHERE id_fecha =".$id_fecha_mtil1;
                
            $sql7 = "UPDATE fecha_actividades 
                            SET codigo_lapso='$cod_lap',fecha_inicio='$fecha_li1',
                                fecha_culminacion='$fecha_lc1',fecha_infinal='$fecha_lif1'
                            WHERE id_fecha =".$id_fecha_li1;
                        
            $sql8 = "UPDATE fecha_actividades 
                            SET codigo_lapso='$cod_lap',fecha_inicio='$fecha_li2',
                                fecha_culminacion='$fecha_lc2',fecha_infinal='$fecha_lif2'
                            WHERE id_fecha =".$id_fecha_li2;
                
            $sql9 = "UPDATE fecha_actividades 
                            SET codigo_lapso='$cod_lap',fecha_inicio='$fecha_li3',
                                fecha_culminacion='$fecha_lc3',fecha_infinal='$fecha_lif3'
                            WHERE id_fecha =".$id_fecha_li3;
            
            $res_fecha1 = mysql_query($sql1) or die(mysql_error());
            $res_fecha2 = mysql_query($sql2) or die(mysql_error());
            $res_fecha3 = mysql_query($sql3) or die(mysql_error());
            $res_fecha4 = mysql_query($sql4) or die(mysql_error());
            $res_fecha5 = mysql_query($sql5) or die(mysql_error());
            $res_fecha6 = mysql_query($sql6) or die(mysql_error());
            $res_fecha7 = mysql_query($sql7) or die(mysql_error());
            $res_fecha8 = mysql_query($sql8) or die(mysql_error());
            $res_fecha9 = mysql_query($sql9) or die(mysql_error());

            if ($reg_evento && $res_fecha1 && $res_fecha2 && $res_fecha3 && 
                        $res_fecha4 && $res_fecha5 && $res_fecha6 && $res_fecha7 
                        && $res_fecha8 && $res_fecha9) {
                echo "<h2>Registro Actualizado exitosamente!</h2>";
            }
        }
    }else{
        echo "<p>Disculpe Existen campos en blancos. Por favor intente de nuevo</p>";
    } 
}
?>    
    
    
    
<div id="mi_form"></div>
    
    
    
    
 
  </div>
<?php include_once '../footer.php';?>

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
    <script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
    <script src="../js/material/material.min.js"></script>
    <script src="../js/material/ripples.min.js"></script>
    <script>
      $.material.init();
    </script>
  <script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="../js/func_cro.js"></script> 
</body>
</html>