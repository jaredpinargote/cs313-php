<?php
$dbUser = 'team05';
$dbPassword = 'team05';
$dbName = 'cs313';
$dbHost = 'localhost';
$dbPort = '5432';
try
{
    $db = new PDO("pgsql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
}
catch (PDOException $ex)
{
    echo "$ex";
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Scripture</title>
</head>
<body>
    <div>
    <h1>Scripture Resources</h1>
        <?php
        $book = $_POST['book'];
        if($book !== NULL){
            $statement = $db->prepare("SELECT book, chapter, verse, content FROM scripture WHERE book=:book");
            $statement->bindValue(':book', $book, PDO::PARAM_STR);
        } else {
            $statement = $db->prepare("SELECT book, chapter, verse, content FROM scripture");
        }
        $statement->execute();
        // echo $statement->fetch()['book'];
        while ($row = $statement->fetch())
        {
            echo '<a href="details.php?book='.$row['book'];
            echo '&chapter='.$row['chapter'];
            echo '&verse='.$row['verse'];
            echo '&content='.$row['content'];
            echo '">';
            echo '<strong>' . $row['book'] . ' ' . $row['chapter'] . ':';
            echo $row['verse'] . '</strong>';
            echo '</a><br>';
        }
        ?>
    </div>
    <form action="team05.php" method="post">
        <input type="text" name="book"></input>
        <button type="submit">Submit</button>
    </form>
</body>
</html>