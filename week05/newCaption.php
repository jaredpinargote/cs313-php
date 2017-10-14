<?php
require 'dbconnect.php';
// $conn = pg_connect('host=localhost dbname=cs313 user=postgres password=1q@W3e$R');

$pid = $_POST['playerID'];
$gid = $_POST['gameID'];
$caption = $_POST['caption'];


$captions = "public.\"Captions\""; 

// // Insert it into the database
$result = pg_query_params($conn,
"INSERT INTO $captions (id, \"caption\", \"playerID\", \"gameID\") VALUES (default, $1, $2, $3)",
array($caption, $pid, $gid));

header("Content-Type: application/json; charset=UTF-8");
if($result !== false){
    $json->message = "success";
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