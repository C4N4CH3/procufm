<?php
include_once "../conexionbd.php";
$sql = "SELECT * FROM menciones";
$res = mysql_query($sql) or die(mysql_error());
echo "<select name='mencion' id='mencion'>";
echo "<option value=''>Seleccione</option>";
while ($f = mysql_fetch_array($res)) {    
    echo "<option value='" . $f["id_mencion"] . "'>" . $f["nombre_mencion"] . "</option>";
}
echo '</select>';
?>