<?php
require "dbconnect.php";

$gid = $_GET['gameID'];
$captions = "public.\"Captions\""; 
$players = "public.\"Players\""; 

$result = pg_query_params($conn,
"SELECT 
    c.caption AS caption, 
    p.name AS name
 FROM $captions c JOIN $players p
 ON c.\"playerID\" = p.id
 WHERE  c.\"gameID\"=$1",
array($gid));  
$allCaptions = pg_fetch_all($result); 
header("Content-Type: application/json; charset=UTF-8");
echo json_encode($allCaptions);
?>