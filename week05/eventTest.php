<?php

// default Heroku Postgres configuration URL
$dbUrl = getenv('DATABASE_URL');

if (empty($dbUrl)) {
    // $dbUrl = "postgres://postgres:1q%40W3e\$R@localhost/cs313";
    $dbHost = "localhost";
    $dbUser = "postgres";
    $dbPassword = '1q@W3e$R';
    $dbName = "cs313";
} else {
    $dbopts = parse_url($dbUrl);
    $dbHost = $dbopts["host"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');
}


if(isset($dbopts["port"]) === true && $dbopts["port"] === ''){
    $dbPort = $dbopts["port"];
    $dbstring = "pgsql:dbname=$dbName;host=$dbHost;port=$dbPort";
} else {
    // error_log("Port NOT specified ");
    $dbstring = "pgsql:dbname=$dbName;host=$dbHost";
    // error_log("DB STRING:" . $dbstring);
}

// try {
    // $dbconn = new PDO($dbstring, $dbUser, $dbPassword);
// }
// catch (PDOException $ex) {
//     error_log($ex->getMessage());
//     // die();
// }

// $dbconn = new PDO("pgsql:host=localhost;dbname=cs313", "postgres", '1q@W3e$R');
$dbconn = new PDO($dbstring, $dbUser, $dbPassword);
$dbconn->exec('LISTEN "player_insert"');

header("X-Accel-Buffering: no");
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
ob_end_flush();
$inc=0;

while (1) {
  $result = "";
  // wait for one Notify 1 seconds instead of using sleep(1)
  $result = $dbconn->pgsqlGetNotify(PDO::FETCH_ASSOC, 1000); 

  if ( $result ) { 
        echo "id: $inc\ndata: ".stripslashes(json_encode($result['payload']))."\n\n";
        $inc++;
  } else {
        echo "id: $inc\ndata:\n\n";
  }

  flush();
}

?>