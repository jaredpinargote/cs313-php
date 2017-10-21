<?php
require 'dbconnect.php';

$did = $_GET['drawingID'];


$drawings = "public.\"Drawings\""; 

$res = pg_query_params($conn,
"SELECT encode(data, 'base64') AS data FROM $drawings WHERE id=$1",
array($did));  
$raw = pg_fetch_result($res, 'data');

// // Convert to binary and send to the browser
header('Content-type: image/png');
echo base64_decode($raw);
?>