<?php
include_once "../conexionbd.php";
$sql = "SELECT * FROM lapso";
$res = mysql_query($sql) or die(mysql_error());
echo "<select name='lapso' id='lapso'>";
echo "<option value=''>Seleccione</option>";
while ($f = mysql_fetch_array($res)) {    
    echo "<option value='" . $f["id_lapso"] . "'>" . $f["codigo_lapso"] . "</option>";
}
echo '</select>';
?>