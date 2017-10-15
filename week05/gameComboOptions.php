<?php
require "dbconnect.php";

$gid = $_GET['gameID'];

$captions = "public.\"Captions\""; 
$drawings = "public.\"Drawings\""; 
$players = "public.\"Players\""; 

$result = pg_query_params($conn,
"SELECT 
    id
 FROM $drawings
 WHERE \"gameID\"=$1",
array($gid));  
$drawingIDs = pg_fetch_all($result);

$result = pg_query_params($conn,
"SELECT 
    id
 FROM $captions
 WHERE \"gameID\"=$1",
array($gid));  
$captionIDs = pg_fetch_all($result);

$allOptions = array();
$allOptions['drawingIDs'] = $drawingIDs;
$allOptions['captionIDs'] = $captionIDs;

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($allOptions);
?>