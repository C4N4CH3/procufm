<?php
class Consulta{
    
    function consultas_bd($sql){
        include_once("../conexionbd.php");        
	$resultado = mysql_query($sql) or die (mysql_error());
	//echo $sql;        
        if (mysql_num_rows($resultado)<=0){
            return 0;
        }else{
            //$result = mysql_query($resultado);		
            //mysql_close($link);
            return $resultado; 
        }     
    }      
}
?>

