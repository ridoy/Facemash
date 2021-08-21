<head>
<link rel="stylesheet" href="style.css" />
</head>
<div class="header">
			<a href="index.php"><h1>NFTRank</h1></a>
</div>
<?php
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);

    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');

    $con=mysqli_connect($hostname, $username, $password, $database);

    $page = $_GET['page'];
    if (empty($_GET) || !is_numeric($page)) {
        $page = 0;
    }
    if ($page < 0) {
        $page = 0;
    }
    if ($page > 99) {
        $page = 99;
    }

	$i=1;
    $limit=100;
    $offset=$page*$limit;
	$query="Select * from photos  order by rating desc limit ".$limit." offset ".$offset;
	$sql=mysqli_query($con, $query);
    if ($con->connect_error) {
        echo "Error";
    }
    echo '<div class="pagination-box">';
    if ($page > 0) {
        echo '<a href="ranking.php?page=' . ($page - 1) . '">< previous 100</a> - ';
    }
    if ($page < 99) {
        echo '<a href="ranking.php?page=' . ($page + 1) . '">next 100 > </a>';
    }
    echo '</div>';
	while($row=mysqli_fetch_array($sql, MYSQLI_ASSOC))
	{	
		echo '<div id="photoRandom-tiny"><img class="image" src="images/'.$row['photo'].'"></br>';
		echo "RANK : <b>".($i+$offset)."</b><br>";
		echo "Current rating : <b>".$row['rating']."</b><br>";
        echo "<a href='https://www.larvalabs.com/cryptopunks/details/".$row['id']."'>About this Punk</a></div>";
		$i++;
	}


	
	
?>
