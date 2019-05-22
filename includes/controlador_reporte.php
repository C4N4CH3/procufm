<?php
include_once '../conexionbd.php';
switch ($_POST['opc']) {
    case 'cargaReporte':        
        $valores= $_POST['valores'];
        
        //condiciones        
        $where='';        
        if($valores['id_lapso']){
            $where.=' WHERE lap.id_lapso='.$valores['id_lapso'];
            if($valores['id_estatus']){
                $where.=' AND al.id_estatus='.$valores['id_estatus'];
            }else{
                $valores['id_estatus']=0;
            }            
            if($valores['id_carrera']){
                $where.=' AND al.id_carrera='.$valores['id_carrera'];
            }else{
                $valores['id_carrera']=0;
            }
            if($valores['id_mencion']){
                $where.=' AND al.id_mencion='.$valores['id_mencion'];
            }else{
                $valores['id_mencion']=0;
            }
            
            
            $sql = "SELECT 
                        al.nombre as nombreAl, al.apellido as apellidoAl, 
                        al.cedula_alumno as cedulaAl, al.carnet as carnet,
                        est.nombre_estatus, lap.codigo_lapso as codigoLapso, 
                        car.nombre_carrera, men.nombre_mencion
                        FROM (((((preinscripcion AS pre
                                INNER JOIN alumno as al 
                                ON pre.id_alumno=al.id_alumnos)
                                INNER JOIN tutor_academico as tu
                                ON pre.id_tutor=tu.id_tutor)
                                INNER JOIN estatus as est
                                ON est.id_estatus=al.id_estatus)
                                INNER JOIN lapso as lap
                                ON lap.id_lapso=pre.codigo_lapso)
                                INNER JOIN carreras as car 
                                ON al.id_carrera=car.id_carrera)
                                INNER JOIN menciones as men
                                ON al.id_mencion=men.id_mencion".$where;

            $res = mysql_query($sql) or die (mysql_error());
            $total=mysql_num_rows($res);
            if ($total>0){
            ?>
            <div>Ver listado en PDF: 
                <a href="verPdfReporte.php?lap=<?php echo $valores['id_lapso']."&&est=".$valores['id_estatus']."&&car=".$valores['id_carrera']."&&men=".$valores['id_mencion']?>" 
                    class="iredit" target="_blank">Generar Pdf</a></div><br>
            <table border="1" id="mi_tabla">
            <thead>
                <tr>
                    <td>Cedula</td>
                    <td>Carnet</td>
                    <td>Datos</td>
                    <td>Carrera</td>
                    <td>Mención</td>
                    <td>Estatus</td>
                    <td>Codigo</td>
                </tr>
            </thead>            
            <?php
            while($f = mysql_fetch_array($res)){
            $nombre = $f["nombreAl"];
            $apellido = $f["apellidoAl"];
            //echo $email = $f["emailAl"];
            $estatus = $f["nombre_estatus"];
            $codigoLapso = $f["codigoLapso"];

            echo "<tbody>";
            echo "<tr>";
            echo "<td>".$f["cedulaAl"]."</td>";
            echo "<td>".$f["carnet"]."</td>";
            echo "<td>".$nombre.' '.$apellido."</td>";
            echo "<td>".$f["nombre_carrera"]."</td>";
            echo "<td>".$f["nombre_mencion"]."</td>";
            echo "<td>".$estatus."</td>";
            echo "<td>".$codigoLapso."</td>";
            echo "</tr>";
            }
                ?>
                </tbody>
            </table>        
            <div>Total:<?php echo $total ?></div>
            <?php
            }else{
                echo "<p>No existen registros</p>";
            }        
        }else{
            echo "<p>Seleccione un lapso</p>";
        }
        
        break;    
        
    default:        
        break;
}
?>