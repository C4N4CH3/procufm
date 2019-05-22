<?php
include_once '../conexionbd.php';
switch ($_POST['opc']) {
    case 'aprobarInforme':
        $val = $_POST['val'];  
        
        $sql = "UPDATE informes SET calificacion_informe='aprobado' WHERE id_informes=$val";			
	$res = mysql_query($sql) or die(mysql_error());
                
        if($res){
            echo 'Aprobado y guardado exitosamente'; 
        }else{
            echo 'Error no se pudo guardar';
        }       
        break;
    
    case 'reprobarInforme':
        $val = $_POST['val'];  
        
        $sql = "UPDATE informes SET calificacion_informe='reprobado' WHERE id_informes=$val";			
	$res = mysql_query($sql) or die(mysql_error());
        
        if($res){
            echo 'Reprobado y guardado exitosamente'; 
        }else{
            echo 'Error no se pudo guardar';
        }              
        break;    
    
        
    case 'aprobarAl':
        $id = $_POST['val'];  
        
        //esatus 4 aprobado
        $sql = "UPDATE alumno "
                . "SET id_estatus=4 "
                . "WHERE id_alumnos=".$id;
        $res = mysql_query($sql) or die(mysql_error());
        
        if($res){
            echo 'Aprobado y guardado exitosamente'; 
        }else{
            echo 'Error no se pudo guardar';
        }       
        break;    
        
    case 'reprobarAl':
        $id = $_POST['val'];  
        //esatus 5 reprobado
        $sql = "UPDATE alumno "
                . "SET id_estatus=5 "
                . "WHERE id_alumnos=".$id;
        $res = mysql_query($sql) or die(mysql_error());
        
        if($res){
            echo 'Reprobado y guardado exitosamente'; 
        }else{
            echo 'Error no se pudo guardar';
        }       
        break;    
        
        
    default:
        
        break;
}
?>