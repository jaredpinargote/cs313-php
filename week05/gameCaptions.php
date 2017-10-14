<?php
require "dbconnect.php";

$gid = $_GET['gameID'];
$captions = "public.\"Captions\""; 

$result = pg_query_params($conn,
"SELECT * FROM $captions WHERE  \"gameID\"=$1",
array($gid));  
// $raw = pg_fetch_result($res, 'data');
// $drawingIDs = array();
// $i = 0;
// while($np = pg_fetch_row($result)){
//     $id = $np[0];
//     $drawingIDs[$i] = $id;
//     $i++;
// }
$allCaptions = pg_fetch_all($result); 
header("Content-Type: application/json; charset=UTF-8");
echo json_encode($allCaptions);
?>