<?php
require 'dbconnect.php';


$gameID = $_GET['gameID'];

$games = "public.\"Games\""; 


$result = pg_query_params($conn,
"UPDATE 
    $games
 SET 
    \"startTimestamp\" = $1 
 WHERE 
    id = $2",
array(date('Y-m-d H:i:s'),$gameID));
?>