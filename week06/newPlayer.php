<?php
require 'dbconnect.php';
// $conn = pg_connect('host=localhost dbname=cs313 user=postgres password=1q@W3e$R');

header("Content-Type: application/json; charset=UTF-8");

/*id (INT)
name (STRING)
gameID (INT) FK*/

$playerName = $_GET['playerName'];
$roomCode = $_GET['roomCode'];

$games = "public.\"Games\""; 
$roomCodes = "public.\"RoomCodes\"";
$players = "public.\"Players\""; 

$result = pg_query_params($conn,
    "SELECT * FROM $roomCodes WHERE \"RoomCodes\".\"roomCode\" = $1",
    array($roomCode)
);

$arr = pg_fetch_array($result);

$gameID = $arr['gameID'];
$json->roomCode = $arr['roomCode'];

if($roomCode == NULL){
    $json->message = "Error: Room Code Invalid";
    echo json_encode($json);
    die();
}


// echo json_encode($json);

$result = pg_query_params($conn,
    "INSERT INTO $players (id, name, \"gameID\") VALUES (default,$1,$2) RETURNING id",
    array($playerName, $gameID)
);
$newPlayerID = pg_fetch_array($result)['id'];

$result = pg_query_params($conn,
"SELECT * FROM $players WHERE id = $1",
array($newPlayerID));

$newPlayer = pg_fetch_array($result);


$json->id = $newPlayer['id'];
$json->name = $newPlayer['name'];
$json->gameID = $newPlayer['gameID'];

echo json_encode($json);

?>