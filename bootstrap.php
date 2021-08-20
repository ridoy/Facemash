<?php

/*
$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');


$con=mysqli_connect($hostname, $username, $password, $database);


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
echo "Connection was successfully established!";

for ($x = 6950; $x<10000;$x++) {
    $file = $x.'.png';
    $query = 'insert into photos (id, photo) values ('.$x.',"'.$file.'")';
        echo $query;
    if ($con->query($query) === TRUE) {
        echo $query;
    } else {
        echo $con->error;
    }

}
 */

?>


