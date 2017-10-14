<?php
require 'dbconnect.php';
// $conn = pg_connect('host=localhost dbname=cs313 user=postgres password=1q@W3e$R');
function randomString($length = 4) {
    $str = "";
    $characters = array_merge(range('A','Z'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}


$games = "public.\"Games\""; 
$roomCodes = "public.\"RoomCodes\"";
$result = pg_query($conn,'INSERT INTO '.$games.' (id, "playerNumber", "startTimestamp", "endTimestamp") VALUES (default,0,NULL,NULL) RETURNING id');
$newGameID = pg_fetch_array($result)['id'];
$tries = 0;
while($tries < 1){
    $roomCode = randomString();
    $exists = @pg_query($conn,'SELECT * FROM '.$roomCodes.'WHERE "roomCode" = "'.$roomCode.'"');
    $result = pg_query_params($conn,'INSERT INTO '.$roomCodes.' ("roomCode", "gameID") VALUES ($1, $2)',
    array($roomCode, $newGameID));
    break;
    if(pg_fetch_array($exists) == NULL){
        error_log("ROOM CODE EXISTS");
        continue;
    }
    else{
        break;
    }
    $tries++;
}
// $json = new stdClass();
$json->gameID = $newGameID;
$json->roomCode = $roomCode;

header("Content-Type: application/json; charset=UTF-8");
// error_log(json_encode($json));
echo json_encode($json);
?>