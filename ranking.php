<head>
<link rel="stylesheet" href="style.css" />
</head>
<div class="header">
			<h1>punkrank</h1>
</div>
<?php
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);

    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');

    $con=mysqli_connect($hostname, $username, $password, $database);

	$i=1;
	$query="Select * from photos  order by rating desc limit 50";
	$sql=mysqli_query($con, $query);
    if ($con->connect_error) {
        echo "Error";
    }
	while($row=mysqli_fetch_array($sql, MYSQLI_ASSOC))
	{	
		echo "<center>";
		echo " -----------------".$i." -----------------";
		echo '<div id="photoRandom-small"><img class="image" src="images/'.$row['photo'].'"></br>';
		echo "Current rating : <b>".$row['rating']."</b><br>";
        echo "Details: <a href='https://www.larvalabs.com/cryptopunks/details/".$row['id']."'>https://www.larvalabs.com/cryptopunks/details/".$row['id']."</a></br>";
		echo "</center>";
		$i++;
	}


	
	
?>
