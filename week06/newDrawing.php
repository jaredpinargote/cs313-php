<?php
require 'dbconnect.php';
// $conn = pg_connect('host=localhost dbname=cs313 user=postgres password=1q@W3e$R');

$img = $_POST['img'];
$pid = $_POST['playerID'];
$gid = $_POST['gameID'];

$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
// // Connect to the database

// // Read in a binary file
// $data = file_get_contents( 'image1.jpg' );

// // Escape the binary data to avoid problems with encoding
$escaped = bin2hex( $data );

$drawings = "public.\"Drawings\""; 

// // Insert it into the database
$result = pg_query_params($conn,
"INSERT INTO $drawings (id, \"data\", \"playerID\", \"gameID\") VALUES (default, decode($1 , 'hex'), $2, $3)",
array($escaped, $pid, $gid));

header("Content-Type: application/json; charset=UTF-8");
$json->message = "success";
echo json_encode($json);

// // Get the bytea data
// $res = pg_query("SELECT encode(data, 'base64') AS data FROM gallery WHERE name='Pine trees'");  
// $raw = pg_fetch_result($res, 'data');

// // Convert to binary and send to the browser
// header('Content-type: image/jpeg');
// echo base64_decode($raw);
?>