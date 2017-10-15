<?php
require 'dbconnect.php';

$pid = $_GET['playerID'];
$gid = $_GET['gameID'];
$cid = $_GET['captionID'];
$did = $_GET['drawingID'];


$combos = "public.\"Combos\""; 

// // Insert it into the database
$result = pg_query_params($conn,
"INSERT INTO $combos (id, \"drawingID\", \"playerID\", \"gameID\", \"captionID\", \"defeated\") 
 VALUES (default, $1, $2, $3, $4, false) RETURNING id",
array($did, $pid, $gid, $cid));

header("Content-Type: application/json; charset=UTF-8");
if($result !== false){
    $json->message = "success";
    $json->comboID = pg_fetch_array($result)['id'];
    echo json_encode($json);
} else {
    $json->message = "fail";
    echo json_encode($json);
}

// // Get the bytea data
// $res = pg_query("SELECT encode(data, 'base64') AS data FROM gallery WHERE name='Pine trees'");  
// $raw = pg_fetch_result($res, 'data');

// // Convert to binary and send to the browser
// header('Content-type: image/jpeg');
// echo base64_decode($raw);
?>