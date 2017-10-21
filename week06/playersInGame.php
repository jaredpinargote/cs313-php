<?php
require 'dbconnect.php';


$gameID = $_GET['gameID'];

$games = "public.\"Games\""; 
$roomCodes = "public.\"RoomCodes\"";
$players = "public.\"Players\""; 


$result = pg_query_params($conn,
"SELECT * FROM $players WHERE \"gameID\" = $1",
array($gameID));

$playersResults = array();

while($np = pg_fetch_row($result)){
    $id = $np[0];
    $name = $np[1];
    $playersResults[$id] = $name;
}

$result = pg_query_params($conn,
"SELECT \"startTimestamp\" FROM $games WHERE id = $1",
array($gameID));
$playersResults['ready'] = pg_fetch_row($result)[0];

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($playersResults);
?>