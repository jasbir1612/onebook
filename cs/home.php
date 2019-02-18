<?php
function sp_get_common($flag)
{
include "connection/config.php";
$result_section_right ="call sp_get_common('".$flag."')";
$resultright_section = $db->query($result_section_right);
$db->close();
$total=0;
if(!($total= $resultright_section->num_rows)==0){
while($row = $resultright_section->fetch_array())
{
$rows[] = $row;
}
$resultright_section->close(); return $rows;}
}

?>



