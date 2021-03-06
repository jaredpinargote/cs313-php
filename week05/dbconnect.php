<?php
// default Heroku Postgres configuration URL
$dbUrl = getenv('DATABASE_URL');

if (empty($dbUrl)) {
    $dbUrl = "postgres://postgres:1q\@W3e\$R@localhost/cs313";
}

$dbopts = parse_url($dbUrl);

$dbHost = $dbopts["host"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

if(isset($dbopts["port"]) === true && $dbopts["port"] === ''){
    $dbPort = $dbopts["port"];
    $dbstring = "host=$dbHost dbname=$dbName user=$dbUser password=$dbPassword port=$dbPort";
} else {
    $dbstring = "host=$dbHost dbname=$dbName user=$dbUser password=$dbPassword";
}

try {
    $conn = pg_connect($dbstring);
}
catch (Exception $ex) {
    error_log($ex->getMessage());
    die();
}
?>