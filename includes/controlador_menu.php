<?php
include_once '../conexionbd.php';
switch ($_POST['opc']) {
    case 'cargaAl':      
        $idal = $_POST['idal'];
        $sql = "SELECT al.cedula_alumno as ced_al,al.id_alumnos as id_al,al.*,us.*,pre.* 
                    FROM alumno AS al 
                    INNER JOIN usuario AS us 
                    ON al.id_usuario=us.id_usuario
                    LEFT JOIN preinscripcion AS pre
                    ON al.id_alumnos=pre.id_alumno
                    WHERE al.id_alumnos=".$idal;
        $res = mysql_query($sql) or die(mysql_error());
        if (mysql_num_rows($res)>0){
            while($fil = mysql_fetch_array($res)) {                    
                $a = array(                        
                        array("nombre" => $fil["nombre"],
                            "apellido" => $fil["apellido"],
                            "cedula" => $fil["ced_al"],
                            "email" => $fil["email"],
                            "carnet" => $fil["carnet"],
                            "direccion_habitacion" => $fil["direccion_habitacion"],
                            "fecha_nacimiento" => $fil["fecha_nacimiento"],
                            "sexo" => $fil["sexo"],
                            "id_carrera" => $fil["id_carrera"],
                            "id_mencion" => $fil["id_mencion"],
                            "creditos_aprobados" => $fil["creditos_aprobados"],
                            "indice_academico" => $fil["indice_academico"],
                            "turno" => $fil["turno"],
                            "semestre" => $fil["semestre"],
                            "telefono_habitacion" => $fil["telefono_habitacion"],
                            "telefono_celular" => $fil["telefono_celular"],
                            "empleo" => $fil["empleo"],
                            "nombre_empleo" => $fil["nombre_empleo"],
                            "cargo_empleo" => $fil["cargo_empleo"],
                            "telefono_empleo" => $fil["telefono_empleo"],
                            "email_empleo" => $fil["email_empleo"]
                        ));
                echo $json = json_encode($a);
            }        
        } else {
            echo 0;
        }
        break;
    case 'eliminarAl':
        $idal = $_POST['idal'];
        $sql = "SELECT * FROM 
                    preinscripcion AS pre 
                INNER JOIN tutor_academico as tuac 
                ON pre.id_tutor=tuac.id_tutor
                WHERE id_alumno=$idal";
        $res = mysql_query($sql) or die (mysql_error());
        
        if($fil = mysql_fetch_array($res)) { 
            $id_tutor = $fil["id_tutor"];
            $can_asig = $fil["cantidad_asignacion_alum"];
            
            $can_asig= $can_asig-1;
            
            if($can_asig>=0){
            $sql3 = "UPDATE tutor_academico 
                    SET cantidad_asignacion_alum=".$can_asig." 
                    WHERE id_tutor=$id_tutor";
            $res3 = mysql_query($sql3) or die (mysql_error());
            }else{
                $res3=TRUE;
            }
            $sql1 = "UPDATE alumno 
                    SET id_estatus=0 
                    WHERE id_alumnos=$idal";
            $res1 = mysql_query($sql1) or die (mysql_error());       
            $sql2="DELETE FROM preinscripcion WHERE id_alumno=$idal";
            $res2 = mysql_query($sql2) or die (mysql_error());        
        }   
        
              
        
        if($res1 && $res2 && $res3){
            echo "Resgistro eliminado exitosamente!"; 
        }else{
            echo "Registro no se pudo eliminar";
        }        
        break;    
    case 'cambiar_status_cronograma':
        $id = $_POST['id'];  
        
        $sql = "SELECT lapso_habilitado 
                    FROM lapso 
                    WHERE id_lapso=$id";
        $res = mysql_query($sql) or die (mysql_error());  
        
        if($fil = mysql_fetch_array($res)) { 
            if($fil["lapso_habilitado"]=='si'){
                $cambio = 'no';
            }else{
                $cambio = 'si';
            }
        }
        
        
        $sql1 = "UPDATE lapso
                    SET lapso_habilitado='".$cambio."' 
                    WHERE id_lapso=$id";
        $res1 = mysql_query($sql1) or die (mysql_error());       
                        
        if($res && $res1){
            echo "Solictud procesada exitosamente!"; 
        }else{
            echo "La solicitud no se pudo procesar";
        }       
        break; 
       
    
    case 'cargaCro':      
        $id = $_POST['id'];
        $sql = "SELECT * FROM 
                    (lapso as lap
                    INNER JOIN fecha_eventos as fev
                    ON lap.id_fecha_evento=fev.id_fecha_evento)
                    INNER JOIN fecha_actividades as fa
                    ON lap.codigo_lapso=fa.codigo_lapso
                    WHERE id_lapso=".$id;
        $res = mysql_query($sql) or die(mysql_error());
        
        
        if (mysql_num_rows($res)>0){
            $rawdata = array();
            $i=0;
            while($row = mysql_fetch_array($res))
            {
                $rawdata[$i] = $row;
                $i++;
            }
            
            echo $json = json_encode($rawdata);
        }
        break;
        
    case 'cargaIra':      
        $val = $_POST['valores'];
        
        $id=$val["id_al"];
        $ira=$val["ira_al"];
        
        if($ira >= 12){		
		echo "<br>Su indice acad&eacute;mico es: ".$ira;
		$consulta_lapso = "select * from lapso where lapso_habilitado='si'";
		$resultado_lapso = mysql_query($consulta_lapso) or die (mysql_error());
		if ($fila1 = mysql_fetch_array($resultado_lapso)){
			$cod_lapso = $fila1["codigo_lapso"];
			//echo "<br> C&oacute;digo del lapso es: ".$cod_lapso;
			
			//consulta tabla fecha_actividades (Tiempo Completo)			
			$consultaFechaAct = "select * from fecha_actividades where codigo_lapso='$cod_lapso' and tipo_pasantias='tiempo completo' and fecha_habilitado='si'";
			$resultadoFechaAct = mysql_query($consultaFechaAct) or die (mysql_error());
			$i=0;			
			if(mysql_num_rows($resultadoFechaAct)>0){				
				while($filaFecha = mysql_fetch_array($resultadoFechaAct)){
					$arreFecha[$i]["idfecha"] = $filaFecha["id_fecha"];
					$arreFecha[$i]["fechaInicio"] = $filaFecha["fecha_inicio"];
					$arreFecha[$i]["fechaCulminacion"] = $filaFecha["fecha_culminacion"];
					$arreFecha[$i]["fechaInforme"] = $filaFecha["fecha_infinal"];
					$i++;				
				}
				echo "<br><p align='center'>Tienes la opci&oacute;n de elegir las siguientes Fechas: <br>";
				echo "Tiempo Completo:<br>";
				echo "Cuarenta(40) d&iacute;as h&aacute;biles (8 semanas)</p>";			
				echo "<table width='100%' border='1'>";
				echo "<tr>";
    			echo "<th width=12% scope=col>&nbsp;</th>";
				echo "<th width=29% scope=col>Inicio</th>";
    			echo "<th width=29% scope=col>Fin</th>";
    			echo "<th width=29% scope=col>Entrega Informe</th>";
  				echo "</tr>";                                
				for($j=0; $j<$i; $j++){
					echo "<tr>";
    				echo "<td align='center'><input type='radio' name='seleccionfecha' id='fecha_".$arreFecha[$j]["idfecha"]."' value=".$arreFecha[$j]["idfecha"]."></td>";
    				echo "<td align='center'>".$arreFecha[$j]["fechaInicio"]."</td>";
    				echo "<td align='center'>".$arreFecha[$j]["fechaCulminacion"]."</td>";
    				echo "<td align='center'>".$arreFecha[$j]["fechaInforme"]."</td>";
  					echo "</tr>";
				}
				echo "</table> <br>";
								
			}
			else{
				echo "<p align='center'>Medio Tiempo: <br>No hay Fechas para seleccionar.</p><br>";								
			}			
			
			//consulta tabla fecha_actividades (Medio Tiempo)
			$consultaFechaAct1 = "select * from fecha_actividades where codigo_lapso='$cod_lapso' and tipo_pasantias='medio tiempo' and fecha_habilitado='si'";
			$resultadoFechaAct1 = mysql_query($consultaFechaAct1) or die (mysql_error());
			if(mysql_num_rows($resultadoFechaAct1)>0){
				$iniciadorfor = $i; 
				while($filaFecha1 = mysql_fetch_array($resultadoFechaAct1)){
					$arreFecha[$i]["idfecha"] = $filaFecha1["id_fecha"];
					$arreFecha[$i]["fechaInicio"] = $filaFecha1["fecha_inicio"];
					$arreFecha[$i]["fechaCulminacion"] = $filaFecha1["fecha_culminacion"];
					$arreFecha[$i]["fechaInforme"] = $filaFecha1["fecha_infinal"];				
					$i++;
				}
				echo "<p align='center'>Medio Tiempo: <br>";			
				echo "Ochenta(80) d&iacute;as h&aacute;biles (168 semanas)</p><br>";
				echo "<table width='100%' border='1'>";
				echo "<tr>";
    			echo "<th width='12%' scope='col'>&nbsp;</th>";
				echo "<th width='29%' scope='col'>Inicio</th>";
    			echo "<th width='29%' scope='col'>Fin</th>";
    			echo "<th width='29%' scope='col'>Entrega Informe</th>";
  				echo "</tr>";
                                
				for($j=$iniciadorfor; $j<$i; $j++){
					echo "<tr>";
    				echo "<td align='center'><input type='radio' name='seleccionfecha' id='fecha_".$arreFecha[$j]["idfecha"]."' value=".$arreFecha[$j]["idfecha"]."></td>";
    				echo "<td align='center'>".$arreFecha[$j]["fechaInicio"]."</td>";
    				echo "<td align='center'>".$arreFecha[$j]["fechaCulminacion"]."</td>";
    				echo "<td align='center'>".$arreFecha[$j]["fechaInforme"]."</td>";
  					echo "</tr>";
				}
				echo "</table> <br>";							
			}
			else{
				echo "<p align=center>Medio Tiempo: <br>No hay Fechas para seleccionar.</p><br>";	
			}			
			
		}else{
			echo "<br>El departamento no ha definido codigo de lapso";
		}		
	}
	else if($ira > 0 && $ira < 12){
		echo "<br>Estimado usuario. El indice acad&eacute;mico es: ".$ira;
		$consulta_lapso = "select * from lapso where lapso_habilitado='si'";
		$resultado_lapso = mysql_query($consulta_lapso) or die (mysql_error());
		if ($fila1 = mysql_fetch_array($resultado_lapso)){
			$cod_lapso = $fila1["codigo_lapso"];
			//echo "<br> C&oacute;digo del lapso es: ".$cod_lapso;
			
			//consulta tabla fecha_actividades (Tiempo Completo)			
			$consultaFechaAct = "select * from fecha_actividades where codigo_lapso='$cod_lapso' and tipo_pasantias='pasantia larga' and fecha_habilitado='si'";
			$resultadoFechaAct = mysql_query($consultaFechaAct) or die (mysql_error());
			$i=0;			
			if(mysql_num_rows($resultadoFechaAct)>0){				
				while($filaFecha = mysql_fetch_array($resultadoFechaAct)){
					$arreFecha[$i]["idfecha"] = $filaFecha["id_fecha"];
					$arreFecha[$i]["fechaInicio"] = $filaFecha["fecha_inicio"];
					$arreFecha[$i]["fechaCulminacion"] = $filaFecha["fecha_culminacion"];
					$arreFecha[$i]["fechaInforme"] = $filaFecha["fecha_infinal"];
					$i++;				
				}
				echo "<br><p align='center'>Tienes la opci&oacute;n de elegir las siguientes Fechas: <br>";
				echo "Pasantias Largas:<br>";
				echo "Cincuenta(50) d&iacute;as h&aacute;biles (10 semanas)</p><br>";			
				echo "<table width='100%' border='1'>";
				echo "<tr>";
    			echo "<th width='12%' scope='col'>&nbsp;</th>";
				echo "<th width='29%' scope='col'>Inicio</th>";
    			echo "<th width='29%' scope='col'>Fin</th>";
    			echo "<th width='29%' scope='col'>Entrega Informe</th>";
  				echo "</tr>";
				for($j=0; $j<$i; $j++){
					echo "<tr>";
    				echo "<td align='center'><input type='radio' name='seleccionfecha' id='fecha_".$arreFecha[$j]["idfecha"]."' value=".$arreFecha[$j]["idfecha"]."></td>";
    				echo "<td align='center'>".$arreFecha[$j]["fechaInicio"]."</td>";
    				echo "<td align='center'>".$arreFecha[$j]["fechaCulminacion"]."</td>";
    				echo "<td align='center'>".$arreFecha[$j]["fechaInforme"]."</td>";
  					echo "</tr>";
				}
				echo "</table> <br>";
								
			}
			else{
				echo "<p align=center>Pasantias Largas: ";
				echo "<br>No hay Fechas para seleccionar.</p><br>";								
			}		
		}
		else{
			echo "<br>El departamento no ha definido codigo de lapso";
		}		
	}else {
		echo "Ud. no se ha preincrito. <br>entre en el menu de Preinscripci&oacute;n.";
	}
        break;   
        
    case 'cargaIns':      
        $id = $_POST['id'];
        /*$sql = "SELECT *,ins.email as email_tutor, ins.id_fecha as id_fecha_ins
                    FROM 
                    (((inscripcion as ins
                    INNER JOIN preinscripcion as pre
                    ON ins.id_preinscripcion=pre.id_preinscripcion)
                    LEFT JOIN alumno as al
                    ON al.id_alumnos=pre.id_alumno)
                    LEFT JOIN tutor_academico as ta
                    ON ta.id_tutor=pre.id_tutor)
                    LEFT JOIN fecha_actividades as fe_ac
                    ON ins.id_fecha=fe_ac.id_fecha
                    WHERE id_alumno=".$id;*/
        
        $sql = "SELECT *,ins.email as email_tutor, ins.id_fecha as id_fecha_ins,
                        vac.nombre as nombre_emp
                    FROM 
                    ((((inscripcion as ins
                    INNER JOIN preinscripcion as pre
                    ON ins.id_preinscripcion=pre.id_preinscripcion)
                    LEFT JOIN alumno as al
                    ON al.id_alumnos=pre.id_alumno)
                    LEFT JOIN tutor_academico as ta
                    ON ta.id_tutor=pre.id_tutor)
                    LEFT JOIN fecha_actividades as fe_ac
                    ON ins.id_fecha=fe_ac.id_fecha)
                    LEFT JOIN vacante_departamento as vac
                    ON ins.id_vacante_dep=vac.id_vacante_departamento
                    WHERE id_alumno=".$id;
        
        $res = mysql_query($sql) or die(mysql_error());
        
        if (mysql_num_rows($res)>0){
            $rawdata = array();
            $i=0;
            while($row = mysql_fetch_array($res))
            {
                $rawdata[$i] = $row;
                $i++;
            }
            
            echo $json = json_encode($rawdata);
        }
        break;    
        
        
    case 'eliminarIns':
        $id = $_POST['id'];
        
        $sql = "SELECT *,ins.email as email_tutor, ins.id_fecha as id_fecha_ins
                    FROM 
                    (((inscripcion as ins
                    INNER JOIN preinscripcion as pre
                    ON ins.id_preinscripcion=pre.id_preinscripcion)
                    LEFT JOIN alumno as al
                    ON al.id_alumnos=pre.id_alumno)
                    LEFT JOIN tutor_academico as ta
                    ON ta.id_tutor=pre.id_tutor)
                    LEFT JOIN fecha_actividades as fe_ac
                    ON ins.id_fecha=fe_ac.id_fecha
                    WHERE id_alumno=".$id;
        $res = mysql_query($sql) or die (mysql_error());        
        if($fil = mysql_fetch_array($res)) { 
            $id_pre = $fil["id_preinscripcion"];
            
            $sql1 = "UPDATE alumno 
                    SET id_estatus=1 
                    WHERE id_alumnos=$id";
            $res1 = mysql_query($sql1) or die (mysql_error());       
            $sql2="DELETE FROM inscripcion WHERE id_preinscripcion=$id_pre";
            $res2 = mysql_query($sql2) or die (mysql_error());        
        }   
                        
        if($res1 && $res2){
            echo "Resgistro eliminado exitosamente!"; 
        }else{
            echo "Registro no se pudo eliminar";
        }        
        break;
        
    
    case 'cargarFormCro':
        $id = $id_fe_ev='';        
        ?>
<h4 align="center">FORMULARIO DE REGISTRO</h4>
        <form action="" method="post" name="form1" id="form1">
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
    <input type="hidden" name="id_fe_ev" id="id_fe_ev" value="<?php echo $id_fe_ev; ?>" />
    
    <table width="100%" align="center">
        <tr>
            <td align="center" colspan="2"><strong>C&oacute;digo del Nuevo Lapso</strong></td>      
        </tr>
        <tr>
            <td align="right">Codigo de Lapso:</td>
            <td><input type="text" name="cod_lapso" id="cod_lapso" 
                       size="10" maxlength="10"/></td>
        </tr>
    </table>
    <hr>
    <table width="100%" align="center">    
        <tr>
            <td align="center" colspan="3"><strong>Fecha de Charla de Inducci&oacute;n</strong></td>
        </tr>
        <tr>
            <td align="center">Diurno</td>
            <td align="center">Vespertino</td>
            <td align="center">Nocturno</td>
        </tr>
        <tr>
            <td align="center"><input type="text" name="reunion_diurno" id="reunion_diurno" 
                           class="datepicker" size="10" maxlength="10" /></td>
            <td align="center"><input type="text" name="reunion_vesper" id="reunion_vesper" 
                           class="datepicker" size="10" maxlength="10" /></td>
            <td align="center"><input type="text" name="reunion_nocturno" id="reunion_nocturno"
                           class="datepicker" size="10" maxlength="10" /></td>
        </tr>
    </table>
    <hr>
    <table width="100%" align="center">
        <tr>
            <td align="center" colspan="2"><strong>Fecha de Preinscripci&oacute;n</strong></td>
        </tr>
        <tr>
            <td align="right">Todos los turnos:</td>
            <td><input type="text" name="fecha_preinscripcion" id="fecha_preinscripcion" 
                                        class="datepicker" size="10" maxlength="10" /></td>
        </tr>
    </table>
    <hr>
    <table width="100%" align="center">   
        <tr>
            <td align="center" colspan="4">
                <strong>Fecha de Lapso de Pasant&iacute;a (tiempo completo)</strong></td>
        </tr>        
        <tr>            
            <td align="center">&nbsp;</td>
            <td align="center">Inicio</td>
            <td align="center">Culminacion</td>
            <td align="center">Informe</td>
        </tr>    
        
    <input type="hidden" name="id_fechatc1" id="id_fecha_1" value="" />
    <td align="center">OPCION 1:</td>
      <td  align="center"> 
        <input name="fecha_tci1" id="fecha_ini_1" type="text" value="" size="10" 
               class="datepicker" maxlength="10" /></td>
      <td width="34%" align="center">
          <input type="text" name="fecha_tcc1" id="fecha_cul_1" 
                 class="datepicker" size="10" maxlength="10" /></td>
      <td width="35%" align="center">
        <input type="text" name="fecha_if1" id="fecha_inf_1" 
                class="datepicker" size="10" maxlength="10" /></td>
      </tr>
    <tr>
        <input type="hidden" name="id_fechatc2" id="id_fecha_2" value="" />
        <td align="center">OPCION 2:</td>
      <td align="center" >
        <input type="text" name="fecha_tci2" id="fecha_ini_2" 
                class="datepicker" size="10" maxlength="10" /></td>
      <td align="center">
          <input type="text" name="fecha_tcc2" id="fecha_cul_2" 
                class="datepicker" size="10" maxlength="10" /></td>
      <td align="center">
        <input type="text" name="fecha_if2" id="fecha_inf_2" 
               class="datepicker" size="10" maxlength="10" /></td>
    </tr>
    <tr>
      <input type="hidden" name="id_fechatc3" id="id_fecha_3" value="" />  
      <td align="center">OPCION 3:</td>
      <td align="center" >
        <input type="text" name="fecha_tci3" id="fecha_ini_3"
               class="datepicker" size="10" maxlength="10" /></td>
      <td align="center">
        <input type="text" name="fecha_tcc3" id="fecha_cul_3"
               class="datepicker" size="10" maxlength="10" /></td>
      <td align="center">
        <input type="text" name="fecha_if3" id="fecha_inf_3" 
               class="datepicker" size="10" maxlength="10" /></td>
    </tr>
    <tr>
      <input type="hidden" name="id_fechatc4" id="id_fecha_4" value="" />    
      <td align="center">OPCION 4:</td>
      <td align="center" >
        <input type="text" name="fecha_tci4" id="fecha_ini_4"
               class="datepicker" size="10" maxlength="10" /></td>
      <td align="center">
        <input type="text" name="fecha_tcc4" id="fecha_cul_4" 
               class="datepicker" size="10" maxlength="10" /></td>
      <td align="center">
        <input type="text" name="fecha_if4" id="fecha_inf_4" 
               class="datepicker" size="10" maxlength="10" /></td>
    </tr>   
    <tr>
      <td align="center" colspan="4"><strong>Fecha de Lapso de Pasant&iacute;a (medio tiempo)</strong></td>
    </tr>
    <tr>
        <input type="hidden" name="id_fecha_mtil1" id="id_fecha_5" value="" /> 
      <td align="center">OPCION 1:</td>
        <td align="center">
        <input type="text" name="fecha_mti1" id="fecha_ini_5" 
               class="datepicker" size="10" maxlength="10" /></td>
      <td align="center" width="34%">
        <input type="text" name="fecha_mtc1" id="fecha_cul_5" 
               class="datepicker" size="10" maxlength="10" /></td>
      <td align="center" width="35%">
        <input type="text" name="fecha_mtif" id="fecha_inf_5" 
               class="datepicker" size="10" maxlength="10" /></td>
    </tr>
    <tr>
      <td align="center" colspan="4">&nbsp;</td>
    </tr>  
    <tr>
      <td align="center" colspan="4"><strong>Fecha de Lapso de Pasantía (Largas)</strong></td>
    </tr>
    <tr>
        <input type="hidden" name="id_fecha_li1" id="id_fecha_6" value="" />
      <td align="center">OPCION 1:</td>
      <td align="center">
        <input type="text" name="fecha_li1" id="fecha_ini_6" 
               class="datepicker" size="10" maxlength="10" /></td>
      <td align="center">
        <input type="text" name="fecha_lc1" id="fecha_cul_6" 
               class="datepicker" size="10" maxlength="10" /></td>
      <td align="center">
        <input type="text" name="fecha_lif1" id="fecha_inf_6" 
               class="datepicker" size="10" maxlength="10" /></td>
    </tr>
    <tr>
        <input type="hidden" name="id_fecha_li2" id="id_fecha_7" value="" />
      <td align="center">OPCION 2:</td>
      <td align="center">
        <input type="text" name="fecha_li2" id="fecha_ini_7" 
               class="datepicker" size="10" maxlength="10" /></td>
      <td align="center">
        <input type="text" name="fecha_lc2" id="fecha_cul_7" 
               class="datepicker" size="10" maxlength="10" /></td>
      <td align="center">
        <input type="text"name="fecha_lif2" id="fecha_inf_7" 
               class="datepicker" size="10" maxlength="10" /></td>
    </tr>
    <tr>
        <input type="hidden" name="id_fecha_li3" id="id_fecha_8" value="" />
      <td align="center">OPCION 3:</td>
      <td align="center">
          <input type="text" name="fecha_li3" id="fecha_ini_8" 
               class="datepicker" size="10" maxlength="10" /></td>
      <td align="center">
        <input type="text" name="fecha_lc3" id="fecha_cul_8"
               class="datepicker" size="10" maxlength="10" /></td>
      <td align="center">
        <input type="text" name="fecha_lif3" id="fecha_inf_8" 
               class="datepicker" size="10" maxlength="10" /></td>
    </tr>
    </table>
    <hr>
        <!--<input type="hidden" name="idFechaEvento" value="<?php //echo $idFechaEvento; ?>" />
        <input type="hidden" name="codigoLapsoAnterior" value="<?php //echo $codigoLapsoAnterior; ?>" /> -->
        <p align="center"><input name="enviar" type="submit" value="Guardar" /></p>
</form>
        <?php        
        break;
    
    
    case 'cargaCentro':
        
        
        
        /******************no esta activaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa*///////////////////////////////
        
        $val = $_POST['valores'];
        $car=$val["id_car"];
        $men=$val["id_men"];
        
        $sql = "SELECT id_vacante_departamento, nombre,
                       vacante_carrera, vacante_mencion,
                       numero_pasantes 
                FROM vacante_departamento
                WHERE vacante_carrera=".$car." 
                AND vacante_mencion=".$men;
        
        $cs = mysql_query($sql) or die(mysql_error());
        if (mysql_num_rows($cs) > 0) {            
        ?>
<table border="1">
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Cantidad</th>
    </tr>
    </thead>
    <tbody>
            <?php
            while($row = mysql_fetch_array($cs)){
                echo "<tr>";
    		echo "<td align='center'>
                    <input type='radio' name='selcentro' 
                    id='centro_".$row["id_vacante_departamento"]."'
                    value=".$row["id_vacante_departamento"]."></td>";
    		echo "<td align='center'>".$row["nombre"]."</td>";
    		echo "<td align='center'>".$row["numero_pasantes"]."</td>";
  		echo "</tr>";
            }
            ?>
    </tbody>
    
    
</table>

        

        CARGAR............../*******************************************///////////////
        
        no esta activaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa

        <?php
        }
        break;
        
    
    
    case 'eliAlumno':        
        /*FUNCION LLAMADA DE LOS FORMUALRIOS ALUMNOS*/
        $id_al = $_POST['id'];
        $sql = "SELECT * 
                    FROM alumno AS al 
                    INNER JOIN usuario AS us 
                    ON al.id_usuario=us.id_usuario
                    WHERE id_alumnos=$id_al";
        $cs = mysql_query($sql) or die(mysql_error());
        if ($cs > 0) {
            if ($resul = mysql_fetch_array($cs)) {
                $id_usu = $resul["id_usuario"];
                $id_es = $resul["id_estatus"];
            }
            if($id_es==0){            
                $sql_al = "DELETE FROM alumno WHERE id_alumnos=$id_al";
                $result1 = mysql_query($sql_al) or die(mysql_error());
                $sql_usu = "DELETE FROM usuario WHERE id_usuario=$id_usu";
                $result2 = mysql_query($sql_usu) or die(mysql_error());
                echo "Se elimino correctamente";
            
            }else{
                echo "Este usuario ya genero algun proceso. No se puede eliminar \n Elimine los procesos generados";
            }
        }

        break;
    
    case 'eliPersonal':        
        /*FUNCION LLAMADA DE LOS FORMUALRIOS ALUMNOS*/
                
        $id_p = $_POST['id'];

        $sql = "SELECT * 
                    FROM departamento AS al 
                    INNER JOIN usuario AS us 
                    ON al.id_usuario=us.id_usuario
                    WHERE id_departamento=$id_p";
        $cs = mysql_query($sql) or die(mysql_error());
        if ($cs > 0) {
            if ($resul = mysql_fetch_array($cs)) {
                $id_usu = $resul["id_usuario"];
            }
            $sql_al = "DELETE FROM departamento WHERE id_departamento=$id_p";
            $result1 = mysql_query($sql_al) or die(mysql_error());
            $sql_usu = "DELETE FROM usuario WHERE id_usuario=$id_usu";
            $result2 = mysql_query($sql_usu) or die(mysql_error());
            echo "Se elimnino correctamente";
        }

        break;    
        
        
    case 'eliTutor':
        $id_tutor = $_POST['id'];

        $sql = "SELECT * 
                    FROM tutor_academico AS al 
                    INNER JOIN usuario AS us 
                    ON al.id_usuario=us.id_usuario
                    WHERE id_tutor= '$id_tutor'";
        $cs = mysql_query($sql) or die(mysql_error());
        if ($cs > 0) {
            if ($resul = mysql_fetch_array($cs)) {
                $id_usu = $resul["id_usuario"];
            }
            $sql_al = "DELETE FROM tutor_academico WHERE id_tutor=$id_tutor";
            $result1 = mysql_query($sql_al) or die(mysql_error());
            $sql_usu = "DELETE FROM usuario WHERE id_usuario=$id_usu";
            $result2 = mysql_query($sql_usu) or die(mysql_error());
            echo "Se elimnino correctamente";
        }
        break;
        
        
    case'guarPermiso':        
        $id_pre = $_POST['id'];
        $con ="select * from preinscripcion where id_preinscripcion=".$id_pre;
        $resul = mysql_query($con) or die (mysql_error());
        if ($fila = mysql_fetch_array($resul)) {
            
            $cant_documentos = $fila["cantidad_documentos_permiso"];            
            
            $cs ="select * from inscripcion where id_preinscripcion=".$id_pre;
            $res = mysql_query($cs) or die (mysql_error());
            if ($f = mysql_fetch_array($res)) {
                $nombre_centro = $f['nombre_empresa'];
                $carta_dirigida = $f['jefe_responsable'];
                $cargo_asignado = $f['cargo_jefe'];
                $telefono_lapso = $f['id_fecha'];
                
            }
            $fecha_actual = date("Y-n-j");
            $total = $cant_documentos + 1;

            if ($cant_documentos<3) {
                $cant_documentos++;
                $sql1 = "INSERT INTO documento 
                            (id_preinscripcion, fecha_actual, nombre_centro, 
                            carta_dirigida, cargo_asignado, telefono_lapso, 
                            id_tipo_documento, documento_estatus)
                        VALUES ($id_pre, '$fecha_actual', '$nombre_centro', 
                                '$carta_dirigida', '$cargo_asignado', $telefono_lapso,
                                2, 'noleido')";
                $cs2 = mysql_query($sql1) or die (mysql_error());

                $sql2 ="UPDATE preinscripcion 
                            SET cantidad_documentos_permiso=$total 
                            WHERE id_preinscripcion=$id_pre";
                $cs3=mysql_query($sql2) or die (mysql_error());
                
                if($cs2 && $cs3){
                    echo "Registro guardado con exito"; 
                }

            }else{
                echo 'Error: Ya ha generado el limite de documentos (3)';
            }
        }
        break;
    case'guarConstancia':        
        $id_pre = $_POST['id'];
        $con ="select * from preinscripcion where id_preinscripcion=".$id_pre;
        $resul = mysql_query($con) or die (mysql_error());
        if ($fila = mysql_fetch_array($resul)) {
            
            $cant_documentos = $fila["cantidad_documentos_constancia"];            
            
            $cs ="select * from inscripcion where id_preinscripcion=".$id_pre;
            $res = mysql_query($cs) or die (mysql_error());
            if ($f = mysql_fetch_array($res)) {
                $nombre_centro = $f['nombre_empresa'];
                $carta_dirigida = $f['jefe_responsable'];
                $cargo_asignado = $f['cargo_jefe'];
                $telefono_lapso = $f['id_fecha'];
                
            }
            $fecha_actual = date("Y-n-j");
            $total = $cant_documentos + 1;

            if ($cant_documentos<3) {
                $cant_documentos++;
                $sql1 = "INSERT INTO documento 
                            (id_preinscripcion, fecha_actual, nombre_centro, 
                            carta_dirigida, cargo_asignado, telefono_lapso, 
                            id_tipo_documento, documento_estatus)
                        VALUES ($id_pre, '$fecha_actual', '$nombre_centro', 
                                '$carta_dirigida', '$cargo_asignado', $telefono_lapso,
                                3, 'noleido')";
                $cs2 = mysql_query($sql1) or die (mysql_error());

                $sql2 ="UPDATE preinscripcion 
                            SET cantidad_documentos_constancia=$total 
                            WHERE id_preinscripcion=$id_pre";
                $cs3=mysql_query($sql2) or die (mysql_error());
                if($cs2 && $cs3){
                    echo "Registro guardado con exito"; 
                }
            }else{
                echo 'Error: Ya ha generado el limite de documentos (3)';
            }
            
        }
        break; 
        
    case 'eliminarDoc':
        $id = $_POST['id'];
        
        $sql = "SELECT *,pre.id_preinscripcion as id_pre 
                    FROM documento AS doc
                    INNER JOIN preinscripcion AS pre
                    ON doc.id_preinscripcion=pre.id_preinscripcion
                    WHERE id_documento=".$id;
        $res = mysql_query($sql) or die (mysql_error());        
        if($fil = mysql_fetch_array($res)) { 
            $id_pre = $fil["id_pre"];
            $id_tipo_doc = $fil["id_tipo_documento"];
            
            
            if($id_tipo_doc==1){
                $condicion='cantidad_documentos_postulacion';
            }elseif($id_tipo_doc==2){
                $condicion='cantidad_documentos_permiso';
            }elseif($id_tipo_doc==3){
                $condicion='cantidad_documentos_constancia';
            }
            
            
            $cant_documentos = $fil["$condicion"];
            
            if($cant_documentos>0){
                $total = $cant_documentos - 1;
            }else{
                $total=0;
            }
            
            $sql_al = "DELETE FROM documento WHERE id_documento=$id";
            $res1 = mysql_query($sql_al) or die(mysql_error());
            
            $sql2 ="UPDATE preinscripcion 
                        SET ".$condicion."=".$total." 
                        WHERE id_preinscripcion=$id_pre"; 
            
            $res2 = mysql_query($sql2) or die (mysql_error());
        }   
                        
        if($res1 && $res2){
            echo "Resgistro eliminado exitosamente!"; 
        }else{
            echo "Registro no se pudo eliminar";
        }        
        break;    
        
    case 'eliminarInf':        
        $val = $_POST['valores'];
        $id_ins=$val["id_ins"];
        $id_inf=$val["id_inf"];
        
        
        $sql = "SELECT cantidad_informes 
            FROM inscripcion 
            WHERE id_inscrito=".$id_ins;
        $res = mysql_query($sql) or die (mysql_error());      
        
        if($fil = mysql_fetch_array($res)) { 
            $cant_documentos = $fil["cantidad_informes"];
            if($cant_documentos>0){
                $total = $cant_documentos - 1;
            }else{
                $total=0;
            }
            
            $sql_al = "DELETE FROM informes WHERE id_informes=$id_inf";
            $res1 = mysql_query($sql_al) or die(mysql_error());
            
            $sql2 ="UPDATE inscripcion 
                        SET cantidad_informes=".$total." 
                        WHERE id_inscrito=$id_ins"; 
            
            $res2 = mysql_query($sql2) or die (mysql_error());
        }   
                        
        if($res1 && $res2){
            echo "Resgistro eliminado exitosamente!"; 
        }else{
            echo "Registro no se pudo eliminar";
        }        
        break;     
       
    case 'cambioClave':
        $valores = $_POST['valores'];
        
        if (!empty($valores['usuario']) && !empty($valores['con_actual']) &&              
            !empty($valores['con_nva']) && !empty($valores['re_con_nva'])){            
            
            //include_once '../conexionbd.php';
            $usuario = trim($valores['usuario']);
            $con_actual = md5(trim($valores['con_actual']));
            $con_nva= trim($valores['con_nva']);
            $re_con_nva = trim($valores['re_con_nva']);
            
            //que sean iguales
            if($con_nva === $re_con_nva){
            
                $sql = "SELECT id_usuario,password FROM usuario WHERE login='$usuario'";
                $res = mysql_query($sql) or die (mysql_error());
                
                if($fil = mysql_fetch_array($res)) { 
                    $password = trim($fil["password"]);
                    $id = $fil["id_usuario"];
                    
                    if ($con_actual===$password){
                        $con_nva = md5($con_nva);                   
                        $sql1 = "UPDATE usuario 
                                SET password='$con_nva'
                                WHERE id_usuario=$id";
                        $res1 = mysql_query($sql1) or die (mysql_error());
                        if($res1==TRUE){
                            echo "<script> alert('¡Gracias! Hemos recibido sus datos');</script>";                
                        }
                        mysql_close($link);
                    }else{
                        echo "<br><p>Error: contraseña ACTUAL incorrecta.</p>";
                    }

                }else{
                    echo "<br><p>Error: su usuario no posee contraseña en el sistema.</p>";
                }
            }else{
                echo "<br><p>Error: las contraseñas NUEVAS no coinciden.</p>";
            }            
        }else{
            echo "<p>Error: Disculpe Existen campos en blancos. Por favor intente de nuevo</p>";
        }   
        break;
        
    case 'mencion': 
        $id = intval($_POST['car']);
        
        //$res = $obj->Registros('fede', "select * from comun.municipio where id_entidad={$_POST['entidad']}");
        //echo json_encode($res);
        $sql = "SELECT * 
            FROM menciones 
            WHERE id_carrera=".$id;
        $res = mysql_query($sql) or die (mysql_error());      
        
        if (mysql_num_rows($res)>0){
            $a= array();
            while($fil = mysql_fetch_array($res)) {                    
                $a[] = array("id_mencion" => $fil["id_mencion"],
                            "nombre_mencion" => utf8_encode(strtoupper($fil["nombre_mencion"]))
                        ); 
                
            }           
            //var_dump($a);
            echo json_encode($a);
        } else {
            echo 0;
        }       
        
        break;
            
    case 'comprobarLogin':
        $login = trim($_POST['login']);
        
        //BUSCA EL LOGIN EN MINISCULA
        $sql = "SELECT * FROM usuario WHERE login = '".strtolower($login)."'";
        $res = mysql_query($sql) or die (mysql_error());      
        
        if (mysql_num_rows($res)>0){
            echo '<img alt="disponible" src="../pasantia/images/malo.png" width="25" height="25"><font size="3px" color="red">No disponible</font>';
        } else {
            //BUSCA EL LOGIN EN MAYUSCULA
            $sql = "SELECT * FROM usuario WHERE login = '".  strtoupper($login)."'";
            $res = mysql_query($sql) or die (mysql_error()); 
            
            if (mysql_num_rows($res)>0){
                echo '<img alt="disponible" src="../pasantia/images/malo.png" width="25" height="25"><font size="3px" color="red">No disponible</font>';
            } else {
                //ESTA DISPONIBLE
                echo '<img alt="disponible" src="../pasantia/images/bueno.png" width="25" height="25"><font size="3px" color="green">Disponible</font>';
            }            
        }       
        break;
    case 'comprobarLogin_externo':
        $login = trim($_POST['login']);
        
        //BUSCA EL LOGIN EN MINISCULA
        $sql = "SELECT * FROM usuario WHERE login = '".strtolower($login)."'";
        $res = mysql_query($sql) or die (mysql_error());      
        
        if (mysql_num_rows($res)>0){
            echo '<img alt="disponible" src="../pasantia/images/malo.png" width="25" height="25"><font size="3px" color="red">No disponible</font>';
        } else {
            //BUSCA EL LOGIN EN MAYUSCULA
            $sql = "SELECT * FROM usuario WHERE login = '".  strtoupper($login)."'";
            $res = mysql_query($sql) or die (mysql_error()); 
            
            if (mysql_num_rows($res)>0){
                echo '<img alt="disponible" src="../pasantia/images/malo.png" width="25" height="25"><font size="3px" color="red">No disponible</font>';
            } else {
                //ESTA DISPONIBLE
                echo '<img alt="disponible" src="../pasantia/images/bueno.png" width="25" height="25"><font size="3px" color="green">Disponible</font>';
            }            
        }       
        break;    
    
    case 'guardarPregunta':    
        $valores = $_POST['valores'];
        $sql = "UPDATE usuario "
                . "SET id_pregunta_secreta=".$valores['pre'].", respuesta='".trim($valores['res'])."'"
                . " WHERE login='".trim($valores['id'])."'";
        
        $res = mysql_query($sql) or die (mysql_error());
        if($res){
            echo "Gracias, Datos guardados con exito";
        }else{
            echo "Error: No se pudo completar el proceso";
        }
        break;
    
    case 'verificarPregunta':        
        $valores = $_POST['valores'];
        $respuesta = trim($valores['respuesta']);
        $id_usuario = $valores['id_usuario'];
        
        $sql= "SELECT *,us.id_usuario as id_usu, ps.descripcion as pregunta_secreta  
                            FROM (alumno AS al 
                            INNER JOIN usuario AS us 
                            ON al.id_usuario=us.id_usuario)
                            LEFT JOIN preguntas_secretas AS ps
                            ON ps.id=us.id_pregunta_secreta
                            WHERE us.id_usuario=".$id_usuario;

        $res = mysql_query($sql) or die (mysql_error());
        if ($fila = mysql_fetch_array($res)){
            $respuesta_bd = trim($fila["respuesta"]);            
            if($respuesta==$respuesta_bd){
                $sql2 = "UPDATE usuario SET password='".md5(123456)."' WHERE id_usuario=".$id_usuario; 
                $res1 = mysql_query($sql2) or die (mysql_error());
                if($res1){
                    echo "Gracias! Su clave fue modificada: 123456";
                }
            }else{
                echo "Error: No es la respuesta. Si no recuerda la Respuesta Secreta pase por el "
                . "Departamento de Pasantias a fin de corregir esto.";
            }
        }
        break;
        
    default:
        
        break;
}
?>