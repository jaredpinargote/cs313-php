<?php
require 'dbconnect.php';

$gid = $_GET['gameID'];


$combos = "public.\"Combos\""; 
$players = "public.\"Players\""; 
$captions = "public.\"Captions\""; 
$drawings = "public.\"Drawings\""; 

$result = pg_query_params($conn,
"SELECT 
    p.\"name\" AS comboPlayerName,
    d.id AS drawingID,
    d.\"playerID\" AS drawingPlayerID,
    ca.\"caption\" AS caption,
    ca.\"playerID\" AS captionPlayerID
 FROM $combos co 
 JOIN $players p
    ON co.\"playerID\" = p.id
 JOIN $drawings d
    ON co.\"drawingID\" = d.id 
 JOIN $captions ca
    ON co.\"captionID\" = ca.id
 WHERE co.\"gameID\"=$1",
array($gid));

$comboResults = array();

// while($combo = pg_fetch_row($result)){
//     $id = $np[0];
//     $name = $np[1];
//     $playersResults[$id] = $name;
// }
$rc = 0; 
while ($combo = pg_fetch_array($result,$rc,PGSQL_ASSOC)) { 
    // print $val["category1"]."<br>";
    // error_log(json_encode($combo)); 
    $comboResults[$rc]['comboPlayerName'] = $combo["comboplayername"];
    $comboResults[$rc]['drawingID'] = $combo["drawingid"];

    $temp = pg_query_params($conn,
    "SELECT \"name\" FROM $players WHERE id = $1",
    array($combo["drawingplayerid"]));

    $comboResults[$rc]['drawingPlayerName'] = pg_fetch_array($temp)["name"];
    $comboResults[$rc]['caption'] = $combo["caption"];

    $temp = pg_query_params($conn,
    "SELECT \"name\" FROM $players WHERE id = $1",
    array($combo["captionplayerid"]));

    $comboResults[$rc]['captionPlayerName'] = pg_fetch_array($temp)["name"];
    $rc++; 
} 
header("Content-Type: application/json; charset=UTF-8");
echo json_encode($comboResults);
?>