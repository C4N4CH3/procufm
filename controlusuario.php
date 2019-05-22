<?php @session_start();

//echo 'Estoy aqui';
//session_register('autentificado');

$nombreusuario = $_POST['nombreusuario'];
$clave = md5($_POST['clave']);

//echo 'Estoy aqui';
include ("conexionbd.php");
$consulta = "select * from usuario where login='$nombreusuario';";
$resultado = mysql_query($consulta) or die (mysql_error());
$user_ip=ObtenerIP();
$conteo=0;
if ($fila = mysql_fetch_array($resultado)) {
    $usuariobd = $fila["login"];
    $passwordbd = $fila["password"];
    $grupobd = $fila["id_grupo"];
    $id_usuario = $fila["id_usuario"];
    $id_preg = $fila["id_pregunta_secreta"];
    $origen = $fila["origen"];
    $bloqueado = $fila["bloqueado"];
    $conteo=$fila["conteo"]+1;
    
    
    if($bloqueado=='1')
    {
		 header("Location: index.php?bloqueado=si");
		 exit();
	}
    
    if ($nombreusuario == $usuariobd && $clave == $passwordbd) {
               
        $id_ip = $fila["ip_session"];
        if($id_ip != NULL){
           echo "<script type='text/javascript'>
                 alert('Usuario ya tiene una sesion abierta en otro equipo');
                 location.href='index.php';
           </script>";
	   exit();
        }
        
  	$sql = "update usuario set usuario.conteo='0' where login='$nombreusuario'";
    	$result = mysql_query($sql);

       if($origen==1){
        
         mysql_close($link);
         $_SESSION['clave'] = $passwordbd;
         $_SESSION['id'] = $id_usuario;
         header("Location: /pasantia/cambia/pregunta.php");
         exit();
       }


        switch ($grupobd) {
            case 1: //Estudiante
                //session_start();
                $consulta2 = "select * from alumno where id_usuario = '$id_usuario'";
                $resultado2 = mysql_query($consulta2) or die(mysql_error());
                if ($fila2 = mysql_fetch_array($resultado2)) {
                    $cedulAlumno = $fila2["cedula_alumno"];
                    $idAlumno = $fila2["id_alumnos"];
                }
                $_SESSION['usuario'] = $usuariobd;
                $_SESSION['autentificado'] = "si";
                $_SESSION['nivel'] = "1";
                $_SESSION['id'] = "1";
                $_SESSION['cedula'] = $cedulAlumno;
                $_SESSION['identificador'] = $idAlumno;

                $ultima_visita = date("Y-n-j H:i:s");
                $nombreusuario = $_SESSION['usuario'];
                $consulta = "select * from usuario where login='$nombreusuario'";
                $resultado = mysql_query($consulta) or die(mysql_error());
                //$sql = "update usuario set ultima_visita='$ultima_visita' where login='$nombreusuario'";
                $sql = "update usuario set ultima_visita='$ultima_visita', ip_session='$user_ip' where login='$nombreusuario'";
                $result = mysql_query($sql);              
                
                if($id_preg<=0 || $id_preg==NULL){
                    mysql_close($link);
                    header("Location: pregunta_secreta/pregunta.php");

                    exit();
                }else{
                    mysql_close($link);
                    header("Location: estudiante/sesionestudiante.php");
                }

                if($passwordbd='e10adc3949ba59abbe56e057f20f883e'){
                    header("Location: estudiante/cambioclave.php");
                }
                
                break;
            case 2: //Departamento
                //session_start();
                $consulta2 = "select * from departamento where id_usuario = '$id_usuario'";
                $resultado2 = mysql_query($consulta2) or die(mysql_error());
                if ($fila2 = mysql_fetch_array($resultado2)) {
                    $cedulaDepartamento = $fila2["cedula_departamento"];
                }
                $_SESSION['autentificado'] = "si";
                $_SESSION['nivel'] = "2";
                $_SESSION['id'] = "2";
                $_SESSION['usuario'] = $usuariobd;
                $_SESSION['cedula'] = $cedulaDepartamento;

                $ultima_visita = date("Y-n-j H:i:s");
                $nombreusuario = $_SESSION['usuario'];
                $consulta = "select * from usuario where login='$nombreusuario'";
                $resultado = mysql_query($consulta) or die(mysql_error());
                $sql = "update usuario set ultima_visita='$ultima_visita', ip_session='$user_ip' where login='$nombreusuario'";
                $result = mysql_query($sql);
                mysql_close($link);
                header("Location: empleado/sesionempleado.php");
                break;
            case 3: //Empresa
                //session_start();
                $consulta2 = "select * from empresa where id_usuario = '$id_usuario'";
                $resultado2 = mysql_query($consulta2) or die(mysql_error());
                if ($fila2 = mysql_fetch_array($resultado2)) {
                    $rif = $fila2["rif"];
                }
                $_SESSION['autentificado'] = "si";
                $_SESSION['nivel'] = "3";
                $_SESSION['id'] = "3";
                $_SESSION['usuario'] = $usuariobd;
                $_SESSION['cedula'] = $rif;

                $ultima_visita = date("Y-n-j H:i:s");
                $nombreusuario = $_SESSION['usuario'];
                $consulta = "select * from usuario where login='$nombreusuario'";
                $resultado = mysql_query($consulta) or die(mysql_error());
                $sql = "update usuario set ultima_visita='$ultima_visita', ip_session='$user_ip' where login='$nombreusuario'";
                $result = mysql_query($sql);
                mysql_close($link);
                header("Location: sesionempresa.php");
                break;
            case 4: //administrador
                //session_start();
                $_SESSION['autentificado'] = 'si';
                $_SESSION['nivel'] = "4";
                $_SESSION['id'] = "4";
                $_SESSION['usuario'] = $usuariobd;

                $ultima_visita = date("Y-n-j H:i:s");
                $nombreusuario = $_SESSION['usuario'];
                $consulta = "select * from usuario where login='$nombreusuario'";
                $resultado = mysql_query($consulta) or die(mysql_error());
                $sql = "update usuario set ultima_visita='$ultima_visita', ip_session='$user_ip' where login='$nombreusuario'";
                $result = mysql_query($sql);
                mysql_close($link);
                header("Location: administrador/sesionadministrador.php");
                break;
            case 5: //Tutor Academico
                //session_start();
                $consulta2 = "select * from tutor_academico where id_usuario='$id_usuario'";
                $resultado2 = mysql_query($consulta2) or die(mysql_error());
                if ($fila2 = mysql_fetch_array($resultado2)) {
                    $cedulaTutor = $fila2["cedula"];
                    $idTutor = $fila2["id_tutor"];
                }

                $_SESSION['autentificado'] = "si";
                $_SESSION['nivel'] = "5";
                $_SESSION['id'] = "5";
                $_SESSION['identificador'] = $idTutor;
                $_SESSION['usuario'] = $usuariobd;
                $_SESSION['cedula'] = $cedulaTutor;

                $ultima_visita = date("Y-n-j H:i:s");
                $nombreusuario = $_SESSION['usuario'];
                $consulta = "select * from usuario where login='$nombreusuario'";
                $resultado = mysql_query($consulta) or die(mysql_error());
                //$sql = "update usuario set ultima_visita='$ultima_visita' where login='$nombreusuario'";
                $sql = "update usuario set ultima_visita='$ultima_visita', ip_session='$user_ip' where login='$nombreusuario'";
                $result = mysql_query($sql);
                mysql_close($link);
                header("Location: tutor/sesiontutoracademico.php");
                break;
            default:
                mysql_close($link);
                header("Location: index.php");
                break;
        }
    } else {
 
 		//conteo es 3 entonces el usuario esta bloqueado
 		if ($conteo=='3')
 		{
			 $sql = "update usuario set usuario.conteo='0', usuario.bloqueado='1' where login='$nombreusuario'";
    		 $result = mysql_query($sql);
    		//Set the first flash message with default class
			 header("Location: index.php?bloqueado=si");
		}
		else
		{
			 $sql = "update usuario set usuario.conteo='$conteo' where login='$nombreusuario'";
    		 $result = mysql_query($sql);
		}
           
        mysql_close($link);
        
        header("Location: index.php?errorclave=si");
   
        
    }
} else 

{
    header("Location: index.php?errorusuario=si");
    mysql_close($link);
}


function ObtenerIP()
{
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
           $ip = getenv("HTTP_CLIENT_IP");
   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
           $ip = getenv("HTTP_X_FORWARDED_FOR");
   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
           $ip = getenv("REMOTE_ADDR");
   else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
           $ip = $_SERVER['REMOTE_ADDR'];
   else
           $ip = "IP desconocida";
   return($ip);
}
?>