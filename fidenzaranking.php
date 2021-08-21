<head>
<link rel="stylesheet" href="style.css" />
</head>
<div class="header">
			<h1>NFTRank</h1>
</div>
<div class="main_wrapper">
    <div style="font-size: 20px">
        <a href="index.php">Vote on CryptoPunks</a>&nbsp;-&nbsp; 
        <a href="fidenza.php">Vote on Fidenza</a>
    </div>
    <h4>by <a href="http://twitter.com/mittendapper">@mittendapper</a></h4>
<?php
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);

    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');

    $con=mysqli_connect($hostname, $username, $password, $database);

	$i=1;
	$query="Select * from fidenza order by rating desc";
	$sql=mysqli_query($con, $query);
    if ($con->connect_error) {
        echo "Error";
    }
    echo "<h3>FIDENZA LEADERBOARD</h3>";
	while($row=mysqli_fetch_array($sql, MYSQLI_ASSOC))
	{	
        $base_url = 'https://filter-blocks.netlify.app/token/78000';
        $url = '';
        $str_id = strval($row['id']);
        if (strlen($str_id) == 1) {
            $url = $base_url . "00" . $str_id;
        } else if (strlen($str_id) == 2) {
            $url = $base_url . "0" . $str_id;
        } else {
            $url = $base_url . $str_id;
        }
        echo "<b>#".($i)."</b> <a href='".$url."'>Fidenza # ".$row['id']."</a> (Current Rating:<b>" . $row['rating']. "</b>)<br/>";
		$i++;
	}
	
?>
</div>
