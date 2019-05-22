<?Php
include_once 'conexionbd.php';

/***********funcion que lista las carrears**********************************/
function _listar_carreras($sel=NULL)
{
$listcarrera="SELECT id_carrera, UPPER(nombre_carrera)
		FROM  carreras
		ORDER BY  nombre_carrera ASC";
	$consulta=mysql_query($listcarrera);
	while ($result = mysql_fetch_array($consulta, MYSQL_NUM))
					 		 
	{
		list($id_carrera, $nombre_carrera)=$result;
		
		//$datos= $nombre.'&nbsp;'.$apellido.'&nbsp;&nbsp;('.$apodo.')';
			
		//echo '<option  value="'.$id_carrera.'">'.utf8_encode($nombre_carrera).'</option>';	
                if($sel==$id_carrera){
                    echo '<option  value="'.$id_carrera.'" selected>'.utf8_encode($nombre_carrera).'</option>';
                }else{
                    echo '<option  value="'.$id_carrera.'">'.utf8_encode($nombre_carrera).'</option>';	
                }
                
	}
	
}
/***********funcion que lista las carrears y menciones**********************************/
function _listar_carrerasd()
{
$listcarrera="SELECT c.id_carrera, UPPER(c.nombre_carrera), m.id_mencion, m.nombre_mencion
		FROM  carreras AS c
		INNER JOIN menciones AS m ON m.id_carrera = c.id_carrera 
		ORDER BY  c.nombre_carrera ASC";
	$consulta=mysql_query($listcarrera);
	
	while ($result = mysql_fetch_array($consulta, MYSQL_NUM))
					 		 
	{
		list($id_carrera, $nombre_carrera)=$result;
		
			//$datos= $nombre.'&nbsp;'.$apellido.'&nbsp;&nbsp;('.$apodo.')';
			
			//echo '<option  value="'.$id_carrera.'">'.utf8_encode($nombre_carrera).'</option>';	
			echo '<option  value="'.$id_carrera.'">'.utf8_encode($nombre_carrera).'</option>';	
				
	}
	
}
/***************************función que lista las menciones****************************************/

function _listar_menciones($sel=NULL)
{
$listmencion="SELECT id_mencion, UPPER(nombre_mencion)
		FROM  menciones
		ORDER BY  nombre_mencion ASC";
	$consulta=mysql_query($listmencion);
	
	while ($result = mysql_fetch_array($consulta, MYSQL_NUM))
					 		 
	{
		list($id_mencion, $nombre_mencion)=$result;
		
		//$datos= $nombre.'&nbsp;'.$apellido.'&nbsp;&nbsp;('.$apodo.')';
		
                if($sel==$id_mencion){
                    echo '<option  value="'.$id_mencion.'" selected>'.utf8_encode($nombre_mencion).'</option>';	
                }else{
                    echo '<option  value="'.$id_mencion.'">'.utf8_encode($nombre_mencion).'</option>';	
                }		
	}
	
}
/***************************función que lista las menciones****************************************/

function _listar_menciones_x_carrera($carrera)
{
$listmencion="SELECT id_mencion, UPPER(nombre_mencion)
		FROM  menciones
		ORDER BY  nombre_mencion ASC";
	$consulta=mysql_query($listmencion);
	
	while ($result = mysql_fetch_array($consulta, MYSQL_NUM))
					 		 
	{
		list($id_mencion, $nombre_mencion)=$result;
		
			//$datos= $nombre.'&nbsp;'.$apellido.'&nbsp;&nbsp;('.$apodo.')';
			
			echo '<option  value="'.$id_mencion.'">'.utf8_encode($nombre_mencion).'</option>';	
				
	}
	
}
/***************************función que lista los turnos****************************************/
/***************************función que lista los turnos****************************************/


function _listar_turnos()
{
$listturno ="SELECT id_turno, UPPER(nombre_turno)
		FROM  turnos
		ORDER BY  id_turno ASC";
	$consulta=mysql_query($listturno);
	
	while ($result = mysql_fetch_array($consulta, MYSQL_NUM))
					 		 
	{
		list($id_turno, $nombre_turno)=$result;
		
			//$datos= $nombre.'&nbsp;'.$apellido.'&nbsp;&nbsp;('.$apodo.')';
			
			echo '<option  value="'.$id_turno.'">'.utf8_encode($nombre_turno).'</option>';	
				
	}
	
}
/************************************funcion que lista los sexos*****************************************/

function _listar_sexos()
{
$listsexo="SELECT id_sexo, UPPER(descripcion_sexo)
		FROM  sexo
		ORDER BY  descripcion_sexo ASC";
	$consulta=mysql_query($listsexo);
	
	while ($result = mysql_fetch_array($consulta, MYSQL_NUM))
					 		 
	{
		list($id_sexo, $descripcion_sexo)=$result;
		
			//$datos= $nombre.'&nbsp;'.$apellido.'&nbsp;&nbsp;('.$apodo.')';
			
			echo '<option  value="'.$id_sexo.'">'.utf8_encode($descripcion_sexo).'</option>';	
				
	}
	
}
/************************************funcion que lista los estatus*****************************************/

function _listar_estatus()
{
$listestatus="SELECT id_estatus, UPPER(nombre_estatus)
		FROM  estatus
		ORDER BY  nombre_estatus ASC";
	$consulta=mysql_query($listestatus);
	
	while ($result = mysql_fetch_array($consulta, MYSQL_NUM))
					 		 
	{
		list($id_estatus, $nombre_estatus)=$result;
		
			//$datos= $nombre.'&nbsp;'.$apellido.'&nbsp;&nbsp;('.$apodo.')';
			
			echo '<option  value="'.$id_estatus.'">'.utf8_encode($nombre_estatus).'</option>';	
				
	}
	
}


/************************************funcion que lista los centros de psasntia*****************************************/

function _listar_centros()
{
$listcentros="SELECT v.id_vacante_departamento, UPPER(v.nombre), UPPER(v.ubicacion), v.numero_pasantes, c.nombre_carrera, m.nombre_mencion
		FROM  vacante_departamento AS v
		INNER JOIN carreras AS c ON v.vacante_carrera= c.id_carrera
		INNER JOIN menciones AS m ON v.vacante_mencion = m.id_mencion
		ORDER BY  v.nombre ASC";
	$consulta=mysql_query($listcentros);
	
	while ($result = mysql_fetch_array($consulta, MYSQL_NUM))
					 		 
	{
		list($id_centro, $nombre, $ubicacion, $num_pasantes, $nombre_carrera, $nombre_mencion)=$result;
		
			?>
            <tr>
            <!--<input type="hidden" value="<?Php //echo $id_centro; ?>" name="id_centro" id="id_centro">-->
                   <td align="center">
                <a href="edita_centropasantia.php?nombre=<?Php echo $id_centro; ?>"><?Php echo $nombre; ?></a>
			</td>
            <td align="center">
            	
                <a href="edita_centropasantia.php?nombre=<?Php echo $id_centro; ?>"><?Php echo $ubicacion; ?></a>
			</td>
            <td  align="center">
            	
                <?Php echo $num_pasantes; ?>
			</td>
            <td align="center">
                <?Php echo utf8_encode($nombre_carrera); ?>
			</td>
            <td align="center">
                <?Php echo utf8_encode($nombre_mencion); ?>
			</td>
            <!--<td align="center">
                <a href="formularioalumnocentroadmin.php?id=<?Php //echo $id_centro; ?>&&nombre=<?Php //echo $nombre; ?>">Agregar</a>
            </td>-->      
            </tr>
            <?Php		
	}
}
	?>