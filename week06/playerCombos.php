<?php
require "dbconnect.php";

$pid = $_GET['playerID'];
$gid = $_GET['gameID'];
$drawings = "public.\"Drawings\""; 

$result = pg_query_params($conn,
"SELECT id FROM $drawings WHERE \"playerID\"=$1 AND \"gameID\"=$2",
array($pid, $gid));  
// $raw = pg_fetch_result($res, 'data');
$drawingIDs = array();
$i = 0;
while($np = pg_fetch_row($result)){
    $id = $np[0];
    $drawingIDs[$i] = $id;
    $i++;
}
header("Content-Type: application/json; charset=UTF-8");
echo json_encode($drawingIDs);
?>